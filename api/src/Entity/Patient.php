<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\PatientRepository")
 */
class Patient
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
     * @Groups({"clinicalcase_read"})
     * @Assert\NotBlank(message="L'age est obligatoire !")
     */
    private $age;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le genre est obligatoire !")
     * @Groups({"clinicalcase_read"})
     */
    private $gender;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\NotBlank(message="L'attribut est un fumeur est obligatoire !")
     * @Groups({"clinicalcase_read"})
     */
    private $isASmoker;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\NotBlank(message="L'attribut si le patient a eu un antecedent medical est obligatoire !")
     * @Groups({"clinicalcase_read"})
     */
    private $isMedicalBackground;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"clinicalcase_read"})
     * @Assert\NotBlank(message="Les problemes de santé du patient est obligatoire !")
     */
    private $problemHealth;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"clinicalcase_read"})
     * @Assert\NotBlank(message="Les traitements du patient est obligatoire !")
     */
    private $inTreatment;

    /**
     * @ORM\OneToOne(targetEntity=ClinicalCaseOmnipratique::class, mappedBy="Patient", cascade={"persist", "remove"})
     */
    private $clinicalCaseOmnipratique;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getIsASmoker(): ?bool
    {
        return $this->isASmoker;
    }

    public function setIsASmoker(bool $isASmoker): self
    {
        $this->isASmoker = $isASmoker;

        return $this;
    }

    public function getIsMedicalBackground(): ?bool
    {
        return $this->isMedicalBackground;
    }

    public function setIsMedicalBackground(bool $isMedicalBackground): self
    {
        $this->isMedicalBackground = $isMedicalBackground;

        return $this;
    }

    public function getProblemHealth(): ?string
    {
        return $this->problemHealth;
    }

    public function setProblemHealth(string $problemHealth): self
    {
        $this->problemHealth = $problemHealth;

        return $this;
    }

    public function getInTreatment(): ?string
    {
        return $this->inTreatment;
    }

    public function setInTreatment(string $inTreatment): self
    {
        $this->inTreatment = $inTreatment;

        return $this;
    }

    public function getClinicalCaseOmnipratique(): ?ClinicalCaseOmnipratique
    {
        return $this->clinicalCaseOmnipratique;
    }

    public function setClinicalCaseOmnipratique(?ClinicalCaseOmnipratique $clinicalCaseOmnipratique): self
    {
        $this->clinicalCaseOmnipratique = $clinicalCaseOmnipratique;

        // set (or unset) the owning side of the relation if necessary
        $newPatient = null === $clinicalCaseOmnipratique ? null : $this;
        if ($clinicalCaseOmnipratique->getPatient() !== $newPatient) {
            $clinicalCaseOmnipratique->setPatient($newPatient);
        }

        return $this;
    }
}
