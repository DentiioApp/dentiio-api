<?php
namespace App\Events;
use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\ImgClinicalCaseOmnipratique;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class UploadImgCcOmni implements EventSubscriberInterface {

    /** @var EntityManager */
    public $em;

    /* @var ParameterBagInterface */
    public $params;

    public function __construct(EntityManagerInterface $em, ParameterBagInterface $params)
    {
        $this->em = $em;
        $this->params = $params;
    }

    public static function getSubscribedEvents(){
        return [
            KernelEvents::VIEW =>['convertImage', EventPriorities::POST_WRITE]
        ];
    }
    public function convertImage(ViewEvent $event){
        $imageClinicalCase = $event->getControllerResult();
        $methods = $event->getRequest()->getMethod();
        if ($imageClinicalCase instanceof ImgClinicalCaseOmnipratique && $methods == 'POST'){
            $imageBase64 = $imageClinicalCase->getImage64();
            $clinicalCase = $imageClinicalCase->getClinicalsCaseOmnipratique();
            $path = $this->base64ToImage($imageBase64,$clinicalCase);
            if ($path != 'ErrorFormat'){
                $imageClinicalCase->setPath($path)
                ->setImage64(null);
                $this->em->persist($imageClinicalCase);
                $this->em->flush();
            }else{
                throw new \Exception("Format incorrect, veuillez inserez une image au format 'jpg', 'jpeg' ou 'png'");
            }
        }
    }

    public function base64ToImage($base64,$clinicalCase){
        $formatAuthorized = [
            'jpg',
            'jpeg',
            "png",
        ];
        $idClinicalCase = $clinicalCase->getId();
        $webPath = $this->getApplicationRootDir() . '/public/images/clinicalCasesOmnipratique/';
        $pathFolder = $webPath . $idClinicalCase . "/" ;
        if (!file_exists($pathFolder)) {
            mkdir($pathFolder, 0777, true);
        }
        $image_parts = explode(";base64,", $base64);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];

        if(in_array($image_type,$formatAuthorized) ){
            $image_base64 = base64_decode($image_parts[1]);
            $imageName = uniqid().'.'.$image_type;
            $file = $pathFolder . $imageName;
            file_put_contents($file, $image_base64);
            $path = "clinicalCasesOmnipratique/".$idClinicalCase."/".$imageName;
            return $path;
        }
        return "ErrorFormat";
    }

    public function getApplicationRootDir(){
        return $this->params->get('kernel.project_dir');
    }

}
