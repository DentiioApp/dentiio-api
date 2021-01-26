<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     normalizationContext={
 *          "groups"={"commentaires_read"}
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\CommentaireRepository")
 */
class Commentaire
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"clinicalcaseOmni_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Inserez un commentaire")
     * @Groups({"clinicalcaseOmni_read"})
     */
    private $comment;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"clinicalcaseOmni_read"})
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="commentaires")
     * @Groups({"clinicalcaseOmni_read"})
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ClinicalCase", inversedBy="commentaires")
     */
    private $clinicalCase;

    /**
     * @ORM\ManyToOne(targetEntity=ClinicalCaseOmnipratique::class, inversedBy="commentaires")
     */
    private $clinicalCaseOmnipratique;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

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

    public function getClinicalCaseOmnipratique(): ?ClinicalCaseOmnipratique
    {
        return $this->clinicalCaseOmnipratique;
    }

    public function setClinicalCaseOmnipratique(?ClinicalCaseOmnipratique $clinicalCaseOmnipratique): self
    {
        $this->clinicalCaseOmnipratique = $clinicalCaseOmnipratique;

        return $this;
    }
}
