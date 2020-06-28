<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\NotificationRepository")
 */
class Notification
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MessageNotification", inversedBy="notifications")
     * @ORM\JoinColumn(nullable=false)
     */
    private $message;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="notificationsSend")
     */
    private $sender;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="notificationsReceive")
     * @ORM\JoinColumn(nullable=false)
     */
    private $receiver;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $viewAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ClinicalCase", inversedBy="notifications")
     */
    private $clinicalCase;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?MessageNotification
    {
        return $this->message;
    }

    public function setMessage(?MessageNotification $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getSender(): ?user
    {
        return $this->sender;
    }

    public function setSender(?user $sender): self
    {
        $this->sender = $sender;

        return $this;
    }

    public function getReceiver(): ?user
    {
        return $this->receiver;
    }

    public function setReceiver(?user $receiver): self
    {
        $this->receiver = $receiver;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getViewAt(): ?\DateTimeInterface
    {
        return $this->viewAt;
    }

    public function setViewAt(?\DateTimeInterface $viewAt): self
    {
        $this->viewAt = $viewAt;

        return $this;
    }

    public function getClinicalCase(): ?clinicalcase
    {
        return $this->clinicalCase;
    }

    public function setClinicalCase(?clinicalcase $clinicalCase): self
    {
        $this->clinicalCase = $clinicalCase;

        return $this;
    }
}
