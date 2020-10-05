<?php
namespace App\Events;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\ClinicalCase;
use App\Entity\ImageClinicalCase;
use App\Entity\User;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;

class ConvertBase64ToImage implements EventSubscriberInterface {
    /* @var ParameterBagInterface */
    public $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    public static function getSubscribedEvents(){
        return [
            KernelEvents::VIEW =>['convertImage', EventPriorities::PRE_WRITE]
        ];
    }
    public function convertImage(ViewEvent $event){
        $entityImage = $event->getControllerResult();
        $methods = $event->getRequest()->getMethod();
//----------------------------------------ImageClinicalCase----------------------------   

        if ($entityImage instanceof ImageClinicalCase && $methods == 'POST'){
            $imageBase64 = $entityImage->getImage64();
            $clinicalCase = $entityImage->getClinicalCase();
            $path = $this->base64ToImage($imageBase64,$clinicalCase);
            if ($path != 'ErrorFormat'){
                $entityImage->setPath($path);
            }else{
                throw new \Exception("Format incorrect, veuillez inserez une image au format 'jpg', 'jpeg' ou 'png'");
            }
        }

//----------------------------------------User----------------------------   
     
        if ($entityImage instanceof User && $methods == 'PUT'){
            $imageBase64 = $entityImage->getLicenceDoc();
            $user = $entityImage->getUser();
            $path = $this->base64ToImageUser($imageBase64,$user);
            if ($path != 'ErrorFormat'){
                $entityImage->setPath($path);
            }else{
                throw new \Exception("Format incorrect, veuillez inserez une image au format 'jpg', 'jpeg' ou 'png'");
            }
        }
    }

//----------------------------------------------------------------------------------------  

//----------------------------------------ImageClinicalCase----------------------------   

    public function base64ToImage($base64,$clinicalCase){
        $formatAuthorized = [
            'jpg',
            'jpeg',
            "png",
        ];
        $idClinicalCase = $clinicalCase->getId();
        $webPath = $this->getApplicationRootDir() . '/public/images/clinicalCases/';
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
            $path = "clinicalCases/".$idClinicalCase."/".$imageName;
            return $path;
        }
        return "ErrorFormat";
    }

//----------------------------------------User----------------------------

    public function base64ToImageUser($base64,$user){
        $formatAuthorized = [
            'jpg',
            'jpeg',
            "png",
        ];
        $idUser = $user->getId();
        $webPath = $this->getApplicationRootDir() . '/public/images/users/';
        $pathFolder = $webPath . $idUser . "/" ;
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
            $path = "users/".$idUser."/".$imageName;
            return $path;
        }
        return "ErrorFormat";
    }

//----------------------------------------------------------------------------------------  

    public function getApplicationRootDir(){
        return $this->params->get('kernel.project_dir');
    }

}