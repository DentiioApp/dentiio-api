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
        $data['licenceDoc'] = $user->getLicenceDoc();
        $data['isEnable'] = $user->getIsEnabled();
        $event->setData($data);
    }




}
