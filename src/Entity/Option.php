<?php

namespace App\Entity;

use App\Repository\OptionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OptionRepository::class)]
#[ORM\Table(name: '`option`')]
class Option
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?bool $Activated = null;

    #[ORM\ManyToOne(inversedBy: 'options')]
    #[ORM\JoinColumn(onDelete:'CASCADE')]
    private ?User $structureParent = null;

    #[ORM\OneToOne(inversedBy: 'daughterOption', cascade: ['persist', 'remove'])]
    private ?GlobalOption $globalOptionParent = null;

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
        return $this->Activated;
    }

    public function setActivated(?bool $Activated): self
    {
        $this->Activated = $Activated;

        return $this;
    }

    public function getStructureParent(): ?User
    {
        return $this->structureParent;
    }

    public function setStructureParent(?User $structureParent): self
    {
        $this->structureParent = $structureParent;

        return $this;
    }

    public function getGlobalOptionParent(): ?GlobalOption
    {
        return $this->globalOptionParent;
    }

    public function setGlobalOptionParent(?GlobalOption $globalOptionParent): self
    {
        $this->globalOptionParent = $globalOptionParent;

        return $this;
    }
}
