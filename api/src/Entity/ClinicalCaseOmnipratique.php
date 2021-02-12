<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ClinicalCaseOmnipratiqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     normalizationContext={
 *          "groups"={"clinicalcaseOmni_read"}
 *     },
 *     attributes={"order"={"createdAt": "DESC"}}
 * )
 * @ORM\Entity(repositoryClass=ClinicalCaseOmnipratiqueRepository::class)
 */
class ClinicalCaseOmnipratique
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
    private $title;

    /**
     * @ORM\OneToOne(targetEntity=Patient::class, inversedBy="clinicalCaseOmnipratique", cascade={"persist", "remove"})
     * @Groups({"clinicalcaseOmni_read"})
     */
    private $Patient;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"clinicalcaseOmni_read"})
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="clinicalCaseOmnipratiques")
     * @Groups({"clinicalcaseOmni_read"})
     */
    private $User;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"clinicalcaseOmni_read"})
     */
    private $ExamDescription;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"clinicalcaseOmni_read"})
     */
    private $pathologie;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"clinicalcaseOmni_read"})
     */
    private $TreatmentDescription;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups({"clinicalcaseOmni_read"})
     */
    private $isEnable;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups({"clinicalcaseOmni_read"})
     */
    private $isDraft;

    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="clinicalCaseOmnipratique")
     * @Groups({"clinicalcaseOmni_read"})
     */
    private $commentaires;

    /**
     * @ORM\OneToMany(targetEntity=Favorite::class, mappedBy="clinicalCaseOmnipratique")
     * @Groups({"clinicalcaseOmni_read"})
     */
    private $favorites;

    /**
     * @ORM\OneToMany(targetEntity=ImgClinicalCaseOmnipratique::class, mappedBy="clinicalsCaseOmnipratique")
     * @Groups({"clinicalcaseOmni_read"})
     */
    private $imgClinicalCaseOmnipratiques;

    /**
     * @ORM\OneToMany(targetEntity=Notation::class, mappedBy="clinicalCaseOmnipratique")
     */
    private $notations;

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
        $this->favorites = new ArrayCollection();
        $this->imgClinicalCaseOmnipratiques = new ArrayCollection();
        $this->notations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getExamDescription(): ?string
    {
        return $this->ExamDescription;
    }

    public function setExamDescription(?string $ExamDescription): self
    {
        $this->ExamDescription = $ExamDescription;

        return $this;
    }

    public function getPathologie(): ?string
    {
        return $this->pathologie;
    }

    public function setPathologie(?string $pathologie): self
    {
        $this->pathologie = $pathologie;

        return $this;
    }

    public function getTreatmentDescription(): ?string
    {
        return $this->TreatmentDescription;
    }

    public function setTreatmentDescription(?string $TreatmentDescription): self
    {
        $this->TreatmentDescription = $TreatmentDescription;

        return $this;
    }

    public function getIsEnable(): ?bool
    {
        return $this->isEnable;
    }

    public function setIsEnable(?bool $isEnable): self
    {
        $this->isEnable = $isEnable;

        return $this;
    }

    public function getIsDraft(): ?bool
    {
        return $this->isDraft;
    }

    public function setIsDraft(?bool $isDraft): self
    {
        $this->isDraft = $isDraft;

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
            $commentaire->setClinicalCaseOmnipratique($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->contains($commentaire)) {
            $this->commentaires->removeElement($commentaire);
            // set the owning side to null (unless already changed)
            if ($commentaire->getClinicalCaseOmnipratique() === $this) {
                $commentaire->setClinicalCaseOmnipratique(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Favorite[]
     */
    public function getFavorites(): Collection
    {
        return $this->favorites;
    }

    public function addFavorite(Favorite $favorite): self
    {
        if (!$this->favorites->contains($favorite)) {
            $this->favorites[] = $favorite;
            $favorite->setClinicalCaseOmnipratique($this);
        }

        return $this;
    }

    public function removeFavorite(Favorite $favorite): self
    {
        if ($this->favorites->contains($favorite)) {
            $this->favorites->removeElement($favorite);
            // set the owning side to null (unless already changed)
            if ($favorite->getClinicalCaseOmnipratique() === $this) {
                $favorite->setClinicalCaseOmnipratique(null);
            }
        }

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
            $imgClinicalCaseOmnipratique->setClinicalsCaseOmnipratique($this);
        }

        return $this;
    }

    public function removeImgClinicalCaseOmnipratique(ImgClinicalCaseOmnipratique $imgClinicalCaseOmnipratique): self
    {
        if ($this->imgClinicalCaseOmnipratiques->contains($imgClinicalCaseOmnipratique)) {
            $this->imgClinicalCaseOmnipratiques->removeElement($imgClinicalCaseOmnipratique);
            // set the owning side to null (unless already changed)
            if ($imgClinicalCaseOmnipratique->getClinicalsCaseOmnipratique() === $this) {
                $imgClinicalCaseOmnipratique->setClinicalsCaseOmnipratique(null);
            }
        }

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
            $notation->setClinicalCaseOmnipratique($this);
        }

        return $this;
    }

    public function removeNotation(Notation $notation): self
    {
        if ($this->notations->contains($notation)) {
            $this->notations->removeElement($notation);
            // set the owning side to null (unless already changed)
            if ($notation->getClinicalCaseOmnipratique() === $this) {
                $notation->setClinicalCaseOmnipratique(null);
            }
        }

        return $this;
    }
}
