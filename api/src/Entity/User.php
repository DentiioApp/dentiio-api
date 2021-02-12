<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 *
 * @ApiResource(
 *     normalizationContext={"groups"={"users_read","jobs_read","avatars_read"}}
 * )
 * @UniqueEntity("email", message="{{ value }} est déjà utilisé, veuillez en choisir un autre")
 * @UniqueEntity("pseudo", message="{{ value }} est déjà utilisé, veuillez en choisir un autre")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"users_read", "clinicalcaseOmni_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\NotBlank(message="Le mail est obligatoire !")
     * @Assert\Email(message="Entrer une adresse mail valide")
     * @Groups({"users_read"})
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(min=3, minMessage="Le nom doit faire au minimum 3 caracteres")
     * @Groups({"users_read", "clinicalcaseOmni_read"})
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(min=3, minMessage="Le prenom doit faire au minimum 3 caracteres")
     * @Groups({"users_read", "clinicalcaseOmni_read"})
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=191, unique=true)
     * @Assert\NotBlank(message="Le pseudo est obligatoire !")
     * @Assert\Length(min=3, minMessage="Le pseudo doit faire au minimum 3 caracteres")
     * @Groups({"users_read", "clinicalcaseOmni_read"})
     */
    private $pseudo;


    /**
     * @ORM\Column(type="json")
     * @Groups({"users_read"})
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Le mot de passe est obligatoire !")
     * @Assert\Length(min=3, minMessage="Le mot de passe doit faire au minimum 3 caracteres")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"users_read"})
     */
    private $licenceDoc;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $image64;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Notation", mappedBy="user")
     */
    private $notations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commentaire", mappedBy="user")
     */
    private $commentaires;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ClinicalCase", mappedBy="user")
     * @ApiSubresource()
     */
    private $clinicalCase;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isEnabled;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Jobs", inversedBy="users")
     * @ORM\JoinColumn(nullable=true)
     * @Groups({"users_read","jobs_read", "clinicalcaseOmni_read"})
     */
    private $job;

    /**
     * @ORM\OneToOne(targetEntity=Avatar::class, mappedBy="user", cascade={"persist", "remove"})
     * @Groups({"users_read","avatars_read", "clinicalcaseOmni_read"})
     */
    private $avatar;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Favorite", mappedBy="userId", orphanRemoval=true)
     * @ApiSubresource()
     */
    private $favorites;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Speciality", inversedBy="users")
     * @Groups({"users_read"})
     */
    private $speciality;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"users_read"})
     */
    private $created_at;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Notification", mappedBy="sender")
     */
    private $notificationsSend;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Notification", mappedBy="receiver")
     */
    private $notificationsReceive;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups({"users_read"})
     */
    private $acceptCgu;

    /**
     * @ORM\OneToMany(targetEntity=ClinicalCaseOmnipratique::class, mappedBy="User")
     * @ApiSubresource()
     */
    private $clinicalCaseOmnipratiques;


    public function __construct()
    {
        $this->notations = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
        $this->clinicalCase = new ArrayCollection();
        $this->favorites = new ArrayCollection();
        $this->speciality = new ArrayCollection();
        $this->notificationsSend = new ArrayCollection();
        $this->notificationsReceive = new ArrayCollection();
        $this->clinicalCaseOmnipratiques = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getLicenceDoc(): ?string
    {
        return $this->licenceDoc;
    }

    public function setLicenceDoc(string $licenceDoc): self
    {
        $this->licenceDoc = $licenceDoc;

        return $this;
    }

    public function getClinicalCase()
    {
        return $this->clinicalCase;
    }

    public function setClinicalCase(?ClinicalCase $clinicalCase): self
    {
        $this->clinicalCase = $clinicalCase;

        // set (or unset) the owning side of the relation if necessary
        $newUser = null === $clinicalCase ? null : $this;
        if ($clinicalCase->getUser() !== $newUser) {
            $clinicalCase->setUser($newUser);
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
            $notation->setUser($this);
        }

        return $this;
    }

    public function removeNotation(Notation $notation): self
    {
        if ($this->notations->contains($notation)) {
            $this->notations->removeElement($notation);
            // set the owning side to null (unless already changed)
            if ($notation->getUser() === $this) {
                $notation->setUser(null);
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
            $commentaire->setUser($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->contains($commentaire)) {
            $this->commentaires->removeElement($commentaire);
            // set the owning side to null (unless already changed)
            if ($commentaire->getUser() === $this) {
                $commentaire->setUser(null);
            }
        }

        return $this;
    }

    public function addClinicalCase(ClinicalCase $clinicalCase): self
    {
        if (!$this->ClinicalCase->contains($clinicalCase)) {
            $this->ClinicalCase[] = $clinicalCase;
            $clinicalCase->setUser($this);
        }

        return $this;
    }

    public function removeClinicalCase(ClinicalCase $clinicalCase): self
    {
        if ($this->ClinicalCase->contains($clinicalCase)) {
            $this->ClinicalCase->removeElement($clinicalCase);
            // set the owning side to null (unless already changed)
            if ($clinicalCase->getUser() === $this) {
                $clinicalCase->setUser(null);
            }
        }

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

    public function getJob(): ?Jobs
    {
        return $this->job;
    }

    public function setJob(?Jobs $job): self
    {
        $this->job = $job;

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
            $favorite->setUserId($this);
        }
    }

    public function removeFavorite(Favorite $favorite): self
    {
        if ($this->favorites->contains($favorite)) {
            $this->favorites->removeElement($favorite);
            // set the owning side to null (unless already changed)
            if ($favorite->getUserId() === $this) {
                $favorite->setUserId(null);
            }
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

    public function removeSpeciality(Speciality $speciality): self
    {
        if ($this->speciality->contains($speciality)) {
            $this->speciality->removeElement($speciality);
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return Collection|Notification[]
     */
    public function getNotificationsSend(): Collection
    {
        return $this->notificationsSend;
    }

    public function addNotificationsSend(Notification $notificationsSend): self
    {
        if (!$this->notificationsSend->contains($notificationsSend)) {
            $this->notificationsSend[] = $notificationsSend;
            $notificationsSend->setSender($this);
        }

        return $this;
    }

    public function removeNotificationsSend(Notification $notificationsSend): self
    {
        if ($this->notificationsSend->contains($notificationsSend)) {
            $this->notificationsSend->removeElement($notificationsSend);
            // set the owning side to null (unless already changed)
            if ($notificationsSend->getSender() === $this) {
                $notificationsSend->setSender(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Notification[]
     */
    public function getNotificationsReceive(): Collection
    {
        return $this->notificationsReceive;
    }

    public function addNotificationsReceive(Notification $notificationsReceive): self
    {
        if (!$this->notificationsReceive->contains($notificationsReceive)) {
            $this->notificationsReceive[] = $notificationsReceive;
            $notificationsReceive->setReceiver($this);
        }

        return $this;
    }

    public function removeNotificationsReceive(Notification $notificationsReceive): self
    {
        if ($this->notificationsReceive->contains($notificationsReceive)) {
            $this->notificationsReceive->removeElement($notificationsReceive);
            // set the owning side to null (unless already changed)
            if ($notificationsReceive->getReceiver() === $this) {
                $notificationsReceive->setReceiver(null);
            }
        }

        return $this;
    }

    public function getAvatar(): ?Avatar
    {
        return $this->avatar;
    }

    public function setAvatar(Avatar $avatar): self
    {
        $this->avatar = $avatar;

        // set the owning side of the relation if necessary
        if ($avatar->getUser() !== $this) {
            $avatar->setUser($this);
        }

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
     * @return User
     */
    public function setImage64($image64)
    {
        $this->image64 = $image64;
        return $this;
    }

    public function getAcceptCgu(): ?bool
    {
        return $this->acceptCgu;
    }

    public function setAcceptCgu(?bool $acceptCgu): self
    {
        $this->acceptCgu = $acceptCgu;

        return $this;
    }

    /**
     * @return Collection|ClinicalCaseOmnipratique[]
     */
    public function getClinicalCaseOmnipratiques(): Collection
    {
        return $this->clinicalCaseOmnipratiques;
    }

    public function addClinicalCaseOmnipratique(ClinicalCaseOmnipratique $clinicalCaseOmnipratique): self
    {
        if (!$this->clinicalCaseOmnipratiques->contains($clinicalCaseOmnipratique)) {
            $this->clinicalCaseOmnipratiques[] = $clinicalCaseOmnipratique;
            $clinicalCaseOmnipratique->setUser($this);
        }

        return $this;
    }

    public function removeClinicalCaseOmnipratique(ClinicalCaseOmnipratique $clinicalCaseOmnipratique): self
    {
        if ($this->clinicalCaseOmnipratiques->contains($clinicalCaseOmnipratique)) {
            $this->clinicalCaseOmnipratiques->removeElement($clinicalCaseOmnipratique);
            // set the owning side to null (unless already changed)
            if ($clinicalCaseOmnipratique->getUser() === $this) {
                $clinicalCaseOmnipratique->setUser(null);
            }
        }

        return $this;
    }
}
