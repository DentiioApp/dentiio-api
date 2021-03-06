<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ImgClinicalCaseOmnipratiqueRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ImgClinicalCaseOmnipratiqueRepository::class)
 */
class ImgClinicalCaseOmnipratique
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"clinicalcaseOmni_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"clinicalcaseOmni_read"})
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"clinicalcaseOmni_read"})
     */
    private $path;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $image64;

    /**
     * @ORM\ManyToOne(targetEntity=ClinicalCaseOmnipratique::class, inversedBy="imgClinicalCaseOmnipratiques")
     */
    private $clinicalsCaseOmnipratique;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups({"clinicalcaseOmni_read"})
     */
    private $isPrincipal;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(?string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getImage64(): ?string
    {
        return $this->image64;
    }

    public function setImage64(?string $image64): self
    {
        $this->image64 = $image64;

        return $this;
    }

    public function getClinicalsCaseOmnipratique(): ?ClinicalCaseOmnipratique
    {
        return $this->clinicalsCaseOmnipratique;
    }

    public function setClinicalsCaseOmnipratique(?ClinicalCaseOmnipratique $clinicalsCaseOmnipratique): self
    {
        $this->clinicalsCaseOmnipratique = $clinicalsCaseOmnipratique;

        return $this;
    }

    public function getIsPrincipal(): ?bool
    {
        return $this->isPrincipal;
    }

    public function setIsPrincipal(?bool $isPrincipal): self
    {
        $this->isPrincipal = $isPrincipal;

        return $this;
    }
}
