<?php
namespace App\Events;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Avatar;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use App\Service\AvatarRandom;

class AvatarGeneratorSubscriber implements EventSubscriberInterface {

    /** @var EntityManager */
    public $em;

    /** @var AvatarRandom */
    public $avatarRandom;

    public function __construct(EntityManagerInterface $em, AvatarRandom $avatarRandom)
    {
        $this->em = $em;
        $this->avatarRandom = $avatarRandom;
    }

    public function randomElement($array){
        $random_keys=array_rand($array,3);
        return $array[$random_keys[0]];
    }

    public static function getSubscribedEvents() : array
    {
        return [
          KernelEvents::VIEW =>['generateAvatar', EventPriorities::POST_WRITE]
        ];
    }

    public function generateAvatar(ViewEvent $event){
        $user = $event->getControllerResult();
        $methods = $event->getRequest()->getMethod();
        if ($user instanceof User && $methods == 'POST'){
            $avatar = new Avatar();
            $avatar->setUser($user)
                ->setAccessoriesType("Blank")
                ->setClotheColor($this->randomElement($this->avatarRandom->clothesColor))
                ->setClotheType($this->randomElement($this->avatarRandom->clothes))
                ->setEyebrowType($this->randomElement($this->avatarRandom->eyebrows))
                ->setEyeType($this->randomElement($this->avatarRandom->eye))
                ->setFacialHairColor($this->randomElement($this->avatarRandom->hairColor))
                ->setFacialHairType($this->randomElement($this->avatarRandom->beard))
                ->setHairColor($this->randomElement($this->avatarRandom->hairColor))
                ->setMouthType($this->randomElement($this->avatarRandom->mouth))
                ->setSkinColor($this->randomElement($this->avatarRandom->skinColor))
                ->setTopType($this->randomElement($this->avatarRandom->hair))
            ;

            $this->em->persist($avatar);
            $this->em->flush();
        }
    }
}
