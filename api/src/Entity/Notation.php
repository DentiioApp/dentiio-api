<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     denormalizationContext={
 *          "disable_type_enforcement"=true
 *     },
 *     normalizationContext={
 *          "groups"={"notations_read"}
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\NotationRepository")
 */
class Notation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"clinicalcase_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Vous devez inserez une note")
     * @Assert\Type(type="integer", message="Vous devez inserez un entier")
     * @Groups({"clinicalcase_read"})
     */
    private $note;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"clinicalcase_read"})
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="notations")
     * @Groups({"clinicalcase_read"})
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ClinicalCase", inversedBy="notations")
     */
    private $clinicalCase;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote($note): self
    {
        $this->note = $note;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getClinicalCase(): ?ClinicalCase
    {
        return $this->clinicalCase;
    }

    public function setClinicalCase(?ClinicalCase $clinicalCase): self
    {
        $this->clinicalCase = $clinicalCase;

        return $this;
    }
}
