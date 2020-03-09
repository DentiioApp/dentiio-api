<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * 
 * @ApiResource
 * @UniqueEntity("email",message="L'email existe déjà")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\NotBlank(message="Le nom est obligatoire !")
     * @Assert\Email(message="Entrer une adresse mail valide")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le nom est obligatoire !")
     * @Assert\Length(min=3, minMessage="Le nom doit faire au minimum 3 caracteres")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le prénom est obligatoire !")
     * @Assert\Length(min=3, minMessage="Le prenom doit faire au minimum 3 caracteres")
     */
    private $prenom;


    /**
     * @ORM\Column(type="json")
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
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $licenceDoc;

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

    public function __construct()
    {
        $this->notations = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
        $this->clinicalCase = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
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

   
}
