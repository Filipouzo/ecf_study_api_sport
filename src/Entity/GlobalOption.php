<?php

namespace App\Entity;

use App\Repository\GlobalOptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GlobalOptionRepository::class)]
class GlobalOption
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column]
    private ?bool $activated = null;

    #[ORM\ManyToOne(inversedBy: 'globalOptions')]
    #[ORM\JoinColumn(onDelete:'CASCADE')]
    private ?User $patnerParent = null;

    #[ORM\OneToOne(mappedBy: 'globalOptionParent', cascade: ['persist', 'remove'])]
    private ?Option $daughterOption = null;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function isActivated(): ?bool
    {
        return $this->activated;
    }

    public function setActivated(bool $activated): self
    {
        $this->activated = $activated;

        return $this;
    }

    public function getPatnerParent(): ?User
    {
        return $this->patnerParent;
    }

    public function setPatnerParent(?User $patnerParent): self
    {
        $this->patnerParent = $patnerParent;

        return $this;
    }

    public function getDaughterOption(): ?Option
    {
        return $this->daughterOption;
    }

    public function setDaughterOption(?Option $daughterOption): self
    {
        // unset the owning side of the relation if necessary
        if ($daughterOption === null && $this->daughterOption !== null) {
            $this->daughterOption->setGlobalOptionParent(null);
        }

        // set the owning side of the relation if necessary
        if ($daughterOption !== null && $daughterOption->getGlobalOptionParent() !== $this) {
            $daughterOption->setGlobalOptionParent($this);
        }

        $this->daughterOption = $daughterOption;

        return $this;
    }

}
