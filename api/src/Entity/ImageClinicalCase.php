<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ImageClinicalCaseRepository")
 */
class ImageClinicalCase
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ImageClinicalCaseType")
     * @Groups({"clinicalcase_read"})
     * @Assert\NotBlank(message="Inserez le type de l'image")
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"clinicalcase_read"})
     */
    private $path;

    /**
     * @Assert\NotBlank(message="Attribut image64 manquant, inserez une image au format base64")
     */
    private $image64;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ClinicalCase", inversedBy="imageClinicalCases")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="Inserez le cas clinique")
     */
    private $clinicalCase;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?ImageClinicalCaseType
    {
        return $this->type;
    }

    public function setType(?ImageClinicalCaseType $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getImage64()
    {
        return $this->image64;
    }

    /**
     * @param mixed $image64
     * @return ImageClinicalCase
     */
    public function setImage64($image64)
    {
        $this->image64 = $image64;
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
