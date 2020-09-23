<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(normalizationContext={
 *          "groups"={"speciality_read"}
 *     })
 * @ORM\Entity(repositoryClass="App\Repository\SpecialityRepository")
 */
class Speciality
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"users_read","clinicalcase_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"users_read","clinicalcase_read", "speciality_read"})
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="speciality")
     */
    private $users;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ClinicalCase", mappedBy="speciality")
     */
    private $clinicalCases;

    public function __construct()
    {
        $this->users = new ArrayCollection();
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
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addSpeciality($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            $user->removeSpeciality($this);
        }

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
            $clinicalCase->addSpeciality($this);
        }

        return $this;
    }

    public function removeClinicalCase(ClinicalCase $clinicalCase): self
    {
        if ($this->clinicalCases->contains($clinicalCase)) {
            $this->clinicalCases->removeElement($clinicalCase);
            $clinicalCase->removeSpeciality($this);
        }

        return $this;
    }
}
