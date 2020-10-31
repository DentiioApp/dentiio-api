<?php
namespace App\Events;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\ImageClinicalCase;
use App\Entity\User;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class UploadLicenceDocUser implements EventSubscriberInterface {
    /* @var ParameterBagInterface */
    public $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    public static function getSubscribedEvents(){
        return [
            KernelEvents::VIEW =>['convertImage', EventPriorities::POST_WRITE]
        ];
    }
    public function convertImage(ViewEvent $event){
        $user = $event->getControllerResult();
        $methods = $event->getRequest()->getMethod();
        if ($user instanceof User && $methods == 'POST'){
            $imageBase64 = $user->getImage64();
            $path = $this->base64ToImage($imageBase64,$user);
            if ($path != 'ErrorFormat'){
                $user->setLicenceDoc($path);
                $user->setImage64(null);
            }else{
                throw new \Exception("Format incorrect, veuillez inserez une image au format 'jpg', 'jpeg', 'pdf' ou 'png'");
            }
        }
    }

    public function base64ToImage($base64,$user){
        $formatAuthorized = [
            'jpg',
            'jpeg',
            "png",
            "pdf"
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

    public function getApplicationRootDir(){
        return $this->params->get('kernel.project_dir');
    }

}