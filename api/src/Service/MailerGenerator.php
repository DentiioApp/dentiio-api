<?php


// src/Service/MessageGenerator.php
namespace App\Service;

use App\Entity\Users;
use App\Form\RegistrationFormType;
use App\Repository\UsersRepository;
use App\Security\UsersAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Swift_Mailer;
use Swift_Message;

class MailerGenerator
{
    public $mailer;

    public function __construct(\Swift_Mailer $mailer){
        $this->mailer = $mailer;
    }
    public function registerMail($user)
    {
        // create message
        /** @var Swift_Message $message */
        $message = (new Swift_Message('Register & account activation '))
        ->setFrom(['contact@edentiio.com' => 'Admin'])
        ->setTo([$user->getEmail() => 'Normal User'])
        ->setBody(
                $user->getNom(), "test este sessidfjsfkjsf sifjd"
        );

        $this->mailer->send($message);
        dump($user->getNom());
        dump($message);
        die;
    }


}
