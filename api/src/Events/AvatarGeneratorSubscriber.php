<?php
namespace App\Events;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Avatar;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class AvatarGeneratorSubscriber implements EventSubscriberInterface {

    /** @var EntityManager */
    public $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public static function getSubscribedEvents(){
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
                ->setClotheColor("Blue")
                ->setClotheType("ShirtCrewNeck")
                ->setEyebrowType("Default")
                ->setEyeType("Dizzy")
                ->setFacialHairColor("BrownDark")
                ->setFacialHairType("Blank")
                ->setHairColor("BrownDark")
                ->setMouthType("Smile")
                ->setSkinColor("Yellow")
                ->setTopType("ShortHairShortWaved");

            $this->em->persist($avatar);
            $this->em->flush();

        }
    }

}
