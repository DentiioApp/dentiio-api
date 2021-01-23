<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ImageClinicalCaseTypeRepository")
 */
class ImageClinicalCaseType
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"clinicalcase_read"})
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=ImgClinicalCaseOmnipratique::class, mappedBy="type")
     */
    private $imgClinicalCaseOmnipratiques;

    public function __construct()
    {
        $this->imgClinicalCaseOmnipratiques = new ArrayCollection();
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
     * @return Collection|ImgClinicalCaseOmnipratique[]
     */
    public function getImgClinicalCaseOmnipratiques(): Collection
    {
        return $this->imgClinicalCaseOmnipratiques;
    }

    public function addImgClinicalCaseOmnipratique(ImgClinicalCaseOmnipratique $imgClinicalCaseOmnipratique): self
    {
        if (!$this->imgClinicalCaseOmnipratiques->contains($imgClinicalCaseOmnipratique)) {
            $this->imgClinicalCaseOmnipratiques[] = $imgClinicalCaseOmnipratique;
            $imgClinicalCaseOmnipratique->setType($this);
        }

        return $this;
    }

    public function removeImgClinicalCaseOmnipratique(ImgClinicalCaseOmnipratique $imgClinicalCaseOmnipratique): self
    {
        if ($this->imgClinicalCaseOmnipratiques->contains($imgClinicalCaseOmnipratique)) {
            $this->imgClinicalCaseOmnipratiques->removeElement($imgClinicalCaseOmnipratique);
            // set the owning side to null (unless already changed)
            if ($imgClinicalCaseOmnipratique->getType() === $this) {
                $imgClinicalCaseOmnipratique->setType(null);
            }
        }

        return $this;
    }
}
