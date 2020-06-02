<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(normalizationContext={
 *          "groups"={"symptome_read"}
 *     })
 * @ORM\Entity(repositoryClass="App\Repository\SymptomeRepository")
 */
class Symptome
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"clinicalcase_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"clinicalcase_read"})
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ClinicalCase", mappedBy="symptome")
     */
    private $clinicalCases;

    public function __construct()
    {
        $this->clinicalCases = new ArrayCollection();
    }

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

    /**
     * @return Collection|ClinicalCase[]
     */
    public function getClinicalCases(): Collection
    {
        return $this->clinicalCases;
    }

    public function addClinicalCase(ClinicalCase $clinicalCase): self
    {
        if (!$this->clinicalCases->contains($clinicalCase)) {
            $this->clinicalCases[] = $clinicalCase;
            $clinicalCase->addSymptome($this);
        }

        return $this;
    }

    public function removeClinicalCase(ClinicalCase $clinicalCase): self
    {
        if ($this->clinicalCases->contains($clinicalCase)) {
            $this->clinicalCases->removeElement($clinicalCase);
            $clinicalCase->removeSymptome($this);
        }

        return $this;
    }
}
