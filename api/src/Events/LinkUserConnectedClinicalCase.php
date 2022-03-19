<?php
namespace App\Events;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\ClinicalCase;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Security;

class LinkUserConnectedClinicalCase implements EventSubscriberInterface {
    /* @var Security */
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::VIEW =>['linkUserConnectedClinicalCase', EventPriorities::PRE_WRITE],
        ];
    }

    public function linkUserConnectedClinicalCase(ViewEvent $event){
        $clinicalCase = $event->getControllerResult();
        $methods = $event->getRequest()->getMethod();
        $usr= $this->security->getUser();
        if ($clinicalCase instanceof ClinicalCase && $methods == 'POST'){
            $clinicalCase->setUser($usr);
            $clinicalCase->setCreatedAt(new \DateTime('NOW'));
        }
    }
}