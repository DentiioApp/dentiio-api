<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\FavoriteRepository")
 */
class Favorite
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\user", inversedBy="favorites")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\clinicalcase", inversedBy="favorites")
     * @ORM\JoinColumn(nullable=false)
     */
    private $clinicalCaseId;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?user
    {
        return $this->userId;
    }

    public function setUserId(?user $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getClinicalCaseId(): ?clinicalcase
    {
        return $this->clinicalCaseId;
    }

    public function setClinicalCaseId(?clinicalcase $clinicalCaseId): self
    {
        $this->clinicalCaseId = $clinicalCaseId;

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
}
