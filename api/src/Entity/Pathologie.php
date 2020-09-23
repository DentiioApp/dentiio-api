<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(normalizationContext={
 *          "groups"={"pathologie_read"}
 *     })
 * @ORM\Entity(repositoryClass="App\Repository\PathologieRepository")
 */
class Pathologie
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
     * @Groups({"clinicalcase_read", "pathologie_read"})
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CategoriePathologie", inversedBy="pathologies")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ClinicalCase", mappedBy="pathologie")
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

    public function getCategorie(): ?CategoriePathologie
    {
        return $this->categorie;
    }

    public function setCategorie(?CategoriePathologie $categorie): self
    {
        $this->categorie = $categorie;

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
            $clinicalCase->addPathologie($this);
        }

        return $this;
    }

    public function removeClinicalCase(ClinicalCase $clinicalCase): self
    {
        if ($this->clinicalCases->contains($clinicalCase)) {
            $this->clinicalCases->removeElement($clinicalCase);
            $clinicalCase->removePathologie($this);
        }

        return $this;
    }
}
