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
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="clinicalCase")
     * @Groups({"clinicalcase_read"})
     */
    private $user;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"clinicalcase_read"})
     */
    private $isEnabled;


    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Symptome", inversedBy="clinicalCases")
     * @Groups({"clinicalcase_read"})
     */
    private $symptome;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Treatment", inversedBy="clinicalCases")
     * @Groups({"clinicalcase_read"})
     */
    private $treatment;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Pathologie", inversedBy="clinicalCases")
     * @Groups({"clinicalcase_read"})
     */
    private $pathologie;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Favorite", mappedBy="clinicalCaseId")
     * @Groups({"clinicalcase_read"})
     */
    private $favorites;


    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Speciality", inversedBy="clinicalCases")
     * @Groups({"clinicalcase_read"})
     */
    private $speciality;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"clinicalcase_read"})
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"clinicalcase_read"})
     */
    private $title;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Notification", mappedBy="clinicalCase")
     * @Groups({"clinicalcase_read"})
     */
    private $notifications;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ImageClinicalCase", mappedBy="clinicalCase", orphanRemoval=true)
     * @Groups({"clinicalcase_read"})
     */
    private $imageClinicalCases;
    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Keyword", inversedBy="clinicalCases")
     * @Groups({"clinicalcase_read"})
     */
    private $keyword;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"clinicalcase_read"})
     */
    private $reason_consult;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"clinicalcase_read"})
     */
    private $scanner;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"clinicalcase_read"})
     */
    private $biopsy;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"clinicalcase_read"})
     */
    private $diagnostic;

    public function __construct()
    {
        $this->notations = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
        $this->symptome = new ArrayCollection();
        $this->treatment = new ArrayCollection();
        $this->pathologie = new ArrayCollection();
        $this->favorites = new ArrayCollection();
        $this->speciality = new ArrayCollection();
        $this->notifications = new ArrayCollection();
        $this->imageClinicalCases = new ArrayCollection();
        $this->keyword = new ArrayCollection();
    }


    /**
     * allows to recover the average of the marks of a clinical case
     * @Groups({"clinicalcase_read"})
     *
     */
    public function getAverageNote(){
        $average = 0;
        $nbNotation = count($this->getNotations());
        foreach ($this->getNotations() as $notation){
            $average += $notation->getNote();
        }
        return $average/$nbNotation;
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


    public function removeSymptome(Symptome $symptome): self
    {
        if ($this->symptome->contains($symptome)) {
            $this->symptome->removeElement($symptome);

        }

        return $this;
    }

    /**
     * @return Collection|Treatment[]
     */
    public function getTreatment(): Collection
    {
        return $this->treatment;
    }

    public function addTreatment(Treatment $treatment): self
    {
        if (!$this->treatment->contains($treatment)) {
            $this->treatment[] = $treatment;
        }

        return $this;
    }

    public function removeTreatment(Treatment $treatment): self
    {
        if ($this->treatment->contains($treatment)) {
            $this->treatment->removeElement($treatment);
        }

        return $this;
    }

    /**
     * @return Collection|Pathologie[]
     */
    public function getPathologie(): Collection
    {
        return $this->pathologie;
    }

    public function addPathologie(Pathologie $pathologie): self
    {
        if (!$this->pathologie->contains($pathologie)) {
            $this->pathologie[] = $pathologie;
        }

        return $this;
    }

    public function removePathologie(Pathologie $pathologie): self
    {
        if ($this->pathologie->contains($pathologie)) {
            $this->pathologie->removeElement($pathologie);
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
            $favorite->setClinicalCaseId($this);
        }
    }

    /**
     * @return Collection|Speciality[]
     */
    public function getSpeciality(): Collection
    {
        return $this->speciality;
    }

    public function addSpeciality(Speciality $speciality): self
    {
        if (!$this->speciality->contains($speciality)) {
            $this->speciality[] = $speciality;
        }

        return $this;
    }

    public function removeFavorite(Favorite $favorite): self
    {
        if ($this->favorites->contains($favorite)) {
            $this->favorites->removeElement($favorite);
            // set the owning side to null (unless already changed)
            if ($favorite->getClinicalCaseId() === $this) {
                $favorite->setClinicalCaseId(null);
            }
        }
    }

    public function removeSpeciality(Speciality $speciality): self
    {
        if ($this->speciality->contains($speciality)) {
            $this->speciality->removeElement($speciality);
        }

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        $slug = $this->slugify($this->title);
        $this->slug = $slug;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $this->slugify($slug);

        return $this;
    }

    public function slugify($string){
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string), '-'));
    }

    /**
     * @return Collection|Notification[]
     */
    public function getNotifications(): Collection
    {
        return $this->notifications;
    }

    public function addNotification(Notification $notification): self
    {
        if (!$this->notifications->contains($notification)) {
            $this->notifications[] = $notification;
            $notification->setClinicalCase($this);
        }

        return $this;
    }

    public function removeNotification(Notification $notification): self
    {
        if ($this->notifications->contains($notification)) {
            $this->notifications->removeElement($notification);
            // set the owning side to null (unless already changed)
            if ($notification->getClinicalCase() === $this) {
                $notification->setClinicalCase(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ImageClinicalCase[]
     */
    public function getImageClinicalCases(): Collection
    {
        return $this->imageClinicalCases;
    }

    public function addImageClinicalCase(ImageClinicalCase $imageClinicalCase): self
    {
        if (!$this->imageClinicalCases->contains($imageClinicalCase)) {
            $this->imageClinicalCases[] = $imageClinicalCase;
            $imageClinicalCase->setClinicalCase($this);
        }
    }

    /**
     * @return Collection|Keyword[]
     */
    public function getKeyword(): Collection
    {
        return $this->keyword;
    }

    public function addKeyword(Keyword $keyword): self
    {
        if (!$this->keyword->contains($keyword)) {
            $this->keyword[] = $keyword;
        }

        return $this;
    }

    public function removeImageClinicalCase(ImageClinicalCase $imageClinicalCase): self
    {
        if ($this->imageClinicalCases->contains($imageClinicalCase)) {
            $this->imageClinicalCases->removeElement($imageClinicalCase);
            // set the owning side to null (unless already changed)
            if ($imageClinicalCase->getClinicalCase() === $this) {
                $imageClinicalCase->setClinicalCase(null);
            }
        }
    }

    public function removeKeyword(Keyword $keyword): self
    {
        if ($this->keyword->contains($keyword)) {
            $this->keyword->removeElement($keyword);
        }

        return $this;
    }

    public function getReasonConsult(): ?string
    {
        return $this->reason_consult;
    }

    public function setReasonConsult(?string $reason_consult): self
    {
        $this->reason_consult = $reason_consult;

        return $this;
    }

    public function getScanner(): ?string
    {
        return $this->scanner;
    }

    public function setScanner(?string $scanner): self
    {
        $this->scanner = $scanner;

        return $this;
    }

    public function getBiopsy(): ?string
    {
        return $this->biopsy;
    }

    public function setBiopsy(?string $biopsy): self
    {
        $this->biopsy = $biopsy;

        return $this;
    }

    public function getDiagnostic(): ?string
    {
        return $this->diagnostic;
    }

    public function setDiagnostic(?string $diagnostic): self
    {
        $this->diagnostic = $diagnostic;

        return $this;
    }
}
