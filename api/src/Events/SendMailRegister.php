<?php
namespace App\Events;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Service\MailerGenerator;

class SendMailRegister implements EventSubscriberInterface {

    public $mailerGenerator;

    public function __construct(MailerGenerator $mailerGenerator)
    {
        $this->mailerGenerator = $mailerGenerator;
    }

    public static function getSubscribedEvents(){
        return [
          KernelEvents::VIEW =>['sendRegisterMail', EventPriorities::POST_WRITE]
        ];
    }

    public function sendRegisterMail(ViewEvent $event){
        $user = $event->getControllerResult();
        $methods = $event->getRequest()->getMethod();
        if ($user instanceof User && $methods == 'POST'){
            $this->mailerGenerator->registerMail($user);
        }
    }

}