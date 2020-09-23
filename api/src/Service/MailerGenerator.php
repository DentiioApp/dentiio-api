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


class MailerGenerator
{
    public $mailer;

    public function __construct(\Swift_Mailer $mailer){
        $this->mailer = $mailer;
    }
    public function registerMail($user)
    {
        // create message
        $message = (new \Swift_Message('Register & account activation '))
        ->setFrom(['contact@edentiio.com' => 'Admin'])
        ->setTo([$user->getEmail() => 'Normal User'])
        ->setBody('This is Message body from Swift mailer SMTP test with Attachment script!');

        $this->mailer->send($message);
        dd("ANzi");
    }


}
