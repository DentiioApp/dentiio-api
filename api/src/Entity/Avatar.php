<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ApiResource(
 *     normalizationContext={
 *          "groups"={"avatars_read"}
 *     })
 * @ORM\Entity(repositoryClass="App\Repository\AvatarRepository")
 */
class Avatar
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"users_read","avatars_read","clinicalcaseOmni_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"users_read","avatars_read","clinicalcaseOmni_read"})
     */
    private $topType;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"users_read","avatars_read","clinicalcaseOmni_read"})
     */
    private $accessoriesType;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"users_read","avatars_read","clinicalcaseOmni_read"})
     */
    private $hairColor;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"users_read","avatars_read","clinicalcaseOmni_read"})
     */
    private $facialHairType;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"users_read","avatars_read","clinicalcaseOmni_read"})
     */
    private $facialHairColor;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"users_read","avatars_read","clinicalcaseOmni_read"})
     */
    private $clotheType;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"users_read","avatars_read","clinicalcaseOmni_read"})
     */
    private $clotheColor;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"users_read","avatars_read","clinicalcaseOmni_read"})
     */
    private $eyeType;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"users_read","avatars_read","clinicalcaseOmni_read"})
     */
    private $eyebrowType;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"users_read","avatars_read","clinicalcaseOmni_read"})
     */
    private $mouthType;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"users_read","avatars_read","clinicalcaseOmni_read"})
     */
    private $skinColor;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="avatar", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getTopType(): ?string
    {
        return $this->topType;
    }

    public function setTopType(?string $topType): self
    {
        $this->topType = $topType;

        return $this;
    }

    public function getAccessoriesType(): ?string
    {
        return $this->accessoriesType;
    }

    public function setAccessoriesType(?string $accessoriesType): self
    {
        $this->accessoriesType = $accessoriesType;

        return $this;
    }

    public function getHairColor(): ?string
    {
        return $this->hairColor;
    }

    public function setHairColor(?string $hairColor): self
    {
        $this->hairColor = $hairColor;

        return $this;
    }

    public function getFacialHairType(): ?string
    {
        return $this->facialHairType;
    }

    public function setFacialHairType(?string $facialHairType): self
    {
        $this->facialHairType = $facialHairType;

        return $this;
    }

    public function getFacialHairColor(): ?string
    {
        return $this->facialHairColor;
    }

    public function setFacialHairColor(?string $facialHairColor): self
    {
        $this->facialHairColor = $facialHairColor;

        return $this;
    }

    public function getClotheType(): ?string
    {
        return $this->clotheType;
    }

    public function setClotheType(?string $clotheType): self
    {
        $this->clotheType = $clotheType;

        return $this;
    }

    public function getClotheColor(): ?string
    {
        return $this->clotheColor;
    }

    public function setClotheColor(?string $clotheColor): self
    {
        $this->clotheColor = $clotheColor;

        return $this;
    }

    public function getEyeType(): ?string
    {
        return $this->eyeType;
    }

    public function setEyeType(?string $eyeType): self
    {
        $this->eyeType = $eyeType;

        return $this;
    }

    public function getEyebrowType(): ?string
    {
        return $this->eyebrowType;
    }

    public function setEyebrowType(?string $eyebrowType): self
    {
        $this->eyebrowType = $eyebrowType;

        return $this;
    }

    public function getMouthType(): ?string
    {
        return $this->mouthType;
    }

    public function setMouthType(?string $mouthType): self
    {
        $this->mouthType = $mouthType;

        return $this;
    }

    public function getSkinColor(): ?string
    {
        return $this->skinColor;
    }

    public function setSkinColor(?string $skinColor): self
    {
        $this->skinColor = $skinColor;

        return $this;
    }
}
