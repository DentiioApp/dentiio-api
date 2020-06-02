<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     normalizationContext={
 *          "groups"={"clinicalcase_read"}
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\ClinicalCaseRepository")
 */
class ClinicalCase
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"clinicalcase_read"})
     */
    private $id;

    /**
     * @Groups({"clinicalcase_read"})
     * @ORM\OneToOne(targetEntity="App\Entity\Patient", cascade={"persist", "remove"})
     */
    private $Patient;
    

    /**
     * @ORM\Column(type="text")
     * @Groups({"clinicalcase_read"})
     * @Assert\NotBlank(message="Inserez une presentation")
     */
    private $presentation;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"clinicalcase_read"})
     */
    private $treatmentPlan;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"clinicalcase_read"})
     */
    private $observation;

    /**
     * @ORM\Column(type="text",nullable=true)
     * @Groups({"clinicalcase_read"})
     */
    private $evolution;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"clinicalcase_read"})
     */
    private $conclusion;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"clinicalcase_read"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"clinicalcase_read"})
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Notation", mappedBy="clinicalCase")
     * @Groups({"clinicalcase_read"})
     */
    private $notations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commentaire", mappedBy="clinicalCase")
     * @Groups({"clinicalcase_read"})
     */
    private $commentaires;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="ClinicalCase")
     * @Groups({"clinicalcase_read"})
     */
    private $user;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"clinicalcase_read"})
     */
    private $isEnabled;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Treatment", mappedBy="clinicalCaseId")
     * @Groups({"clinicalcase_read"})
     */
    private $treatments;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Symptome", inversedBy="clinicalCases")
     * @Groups({"clinicalcase_read"})
     */
    private $symptome;


    public function __construct()
    {
        $this->notations = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
        $this->treatments = new ArrayCollection();
        $this->symptome = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getSmoking(): ?bool
    {
        return $this->smoking;
    }

    public function setSmoking(?bool $smoking): self
    {
        $this->smoking = $smoking;

        return $this;
    }

    public function getPresentation(): ?string
    {
        return $this->presentation;
    }

    public function setPresentation(string $presentation): self
    {
        $this->presentation = $presentation;

        return $this;
    }

    public function getTreatmentPlan(): ?string
    {
        return $this->treatmentPlan;
    }

    public function setTreatmentPlan(string $treatmentPlan): self
    {
        $this->treatmentPlan = $treatmentPlan;

        return $this;
    }

    public function getObservation(): ?string
    {
        return $this->observation;
    }

    public function setObservation(string $observation): self
    {
        $this->observation = $observation;

        return $this;
    }

    public function getEvolution(): ?string
    {
        return $this->evolution;
    }

    public function setEvolution(string $evolution): self
    {
        $this->evolution = $evolution;

        return $this;
    }

    public function getConclusion(): ?string
    {
        return $this->conclusion;
    }

    public function setConclusion(string $conclusion): self
    {
        $this->conclusion = $conclusion;

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

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getAverage(): ?float
    {
        return $this->average;
    }

    public function setAverage(float $average): self
    {
        $this->average = $average;

        return $this;
    }


    /**
     * @return Collection|Notation[]
     */
    public function getNotations(): Collection
    {
        return $this->notations;
    }

    public function addNotation(Notation $notation): self
    {
        if (!$this->notations->contains($notation)) {
            $this->notations[] = $notation;
            $notation->setClinicalCase($this);
        }

        return $this;
    }

    public function removeNotation(Notation $notation): self
    {
        if ($this->notations->contains($notation)) {
            $this->notations->removeElement($notation);
            // set the owning side to null (unless already changed)
            if ($notation->getClinicalCase() === $this) {
                $notation->setClinicalCase(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Commentaire[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setClinicalCase($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->contains($commentaire)) {
            $this->commentaires->removeElement($commentaire);
            // set the owning side to null (unless already changed)
            if ($commentaire->getClinicalCase() === $this) {
                $commentaire->setClinicalCase(null);
            }
        }

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

    public function getIsEnabled(): ?bool
    {
        return $this->isEnabled;
    }

    public function setIsEnabled(bool $isEnabled): self
    {
        $this->isEnabled = $isEnabled;

        return $this;
    }

    public function getPatient(): ?Patient
    {
        return $this->Patient;
    }

    public function setPatient(?Patient $Patient): self
    {
        $this->Patient = $Patient;

        return $this;
    }

    /**

     * @return Collection|Treatment[]
     */
    public function getTreatments(): Collection
    {
        return $this->treatments;
    }

    public function addTreatment(Treatment $treatment): self
    {
        if (!$this->treatments->contains($treatment)) {
            $this->treatments[] = $treatment;
            $treatment->setClinicalCaseId($this);
        }

        return $this;
    }
    /**
     * @return Collection|Symptome[]
     */
    public function getSymptome(): Collection
    {
        return $this->symptome;
    }

    public function addSymptome(Symptome $symptome): self
    {
        if (!$this->symptome->contains($symptome)) {
            $this->symptome[] = $symptome;

        }

        return $this;
    }


    public function removeTreatment(Treatment $treatment): self
    {
        if ($this->treatments->contains($treatment)) {
            $this->treatments->removeElement($treatment);
            // set the owning side to null (unless already changed)
            if ($treatment->getClinicalCaseId() === $this) {
                $treatment->setClinicalCaseId(null);
            }

    public function removeSymptome(Symptome $symptome): self
    {
        if ($this->symptome->contains($symptome)) {
            $this->symptome->removeElement($symptome);

        }

        return $this;
    }

    public function getCaseTreatment(): ?CaseTreatment
    {
        return $this->caseTreatment;
    }

    public function setCaseTreatment(?CaseTreatment $caseTreatment): self
    {
        $this->caseTreatment = $caseTreatment;

        return $this;
    }


}
