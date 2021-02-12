<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(normalizationContext={
 *          "groups"={"categoriePathologies_read"}
 *     })
 * @ORM\Entity(repositoryClass="App\Repository\CategoriePathologieRepository")
 */
class CategoriePathologie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"categoriePathologies_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     * @Groups({"categoriePathologies_read"})
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Pathologie", mappedBy="categorie")
     * @Groups({"categoriePathologies_read"})
     */
    private $pathologies;

    public function __construct()
    {
        $this->pathologies = new ArrayCollection();
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
     * @return Collection|Pathologie[]
     */
    public function getPathologies(): Collection
    {
        return $this->pathologies;
    }

    public function addPathology(Pathologie $pathology): self
    {
        if (!$this->pathologies->contains($pathology)) {
            $this->pathologies[] = $pathology;
            $pathology->setCategorie($this);
        }

        return $this;
    }

    public function removePathology(Pathologie $pathology): self
    {
        if ($this->pathologies->contains($pathology)) {
            $this->pathologies->removeElement($pathology);
            // set the owning side to null (unless already changed)
            if ($pathology->getCategorie() === $this) {
                $pathology->setCategorie(null);
            }
        }

        return $this;
    }
}
