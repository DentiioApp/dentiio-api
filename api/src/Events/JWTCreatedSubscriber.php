<?php
namespace App\Events;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;


class JWTCreatedSubscriber {


    public function updateJwtData(JWTCreatedEvent $event)
    {
        $user = $event->getUser();
        $data = $event->getData();
        $data['userId'] = $user->getId();
        $data['pseudo'] = $user->getPseudo();
        $event->setData($data);
    }




}