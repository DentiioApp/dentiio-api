<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(normalizationContext={
 *          "groups"={"treatment_read"}
 *     })
 * @ORM\Entity(repositoryClass="App\Repository\TreatmentRepository")
 */
class Treatment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"clinicalcase_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     * @Groups({"clinicalcase_read"})
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CategorieTreatment", inversedBy="treatments")
     * @ORM\JoinColumn(nullable=false)
     * 
     */
    private $categorieId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ClinicalCase", inversedBy="treatments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $clinicalCaseId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCategorieId(): ?CategorieTreatment
    {
        return $this->categorieId;
    }

    public function setCategorieId(?CategorieTreatment $categorieId): self
    {
        $this->categorieId = $categorieId;

        return $this;
    }

    public function getClinicalCaseId(): ?ClinicalCase
    {
        return $this->clinicalCaseId;
    }

    public function setClinicalCaseId(?ClinicalCase $clinicalCaseId): self
    {
        $this->clinicalCaseId = $clinicalCaseId;

        return $this;
    }
}
