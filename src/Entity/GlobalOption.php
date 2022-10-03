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

    #[ORM\OneToMany(mappedBy: 'globalOption', targetEntity: User::class)]
    private Collection $id_admin;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'globalOptions')]
    private Collection $id_partner;

    public function __construct()
    {
        $this->id_admin = new ArrayCollection();
        $this->id_partner = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, User>
     */
    public function getIdAdmin(): Collection
    {
        return $this->id_admin;
    }

    public function addIdAdmin(User $idAdmin): self
    {
        if (!$this->id_admin->contains($idAdmin)) {
            $this->id_admin->add($idAdmin);
            $idAdmin->setGlobalOption($this);
        }

        return $this;
    }

    public function removeIdAdmin(User $idAdmin): self
    {
        if ($this->id_admin->removeElement($idAdmin)) {
            // set the owning side to null (unless already changed)
            if ($idAdmin->getGlobalOption() === $this) {
                $idAdmin->setGlobalOption(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getIdPartner(): Collection
    {
        return $this->id_partner;
    }

    public function addIdPartner(User $idPartner): self
    {
        if (!$this->id_partner->contains($idPartner)) {
            $this->id_partner->add($idPartner);
        }

        return $this;
    }

    public function removeIdPartner(User $idPartner): self
    {
        $this->id_partner->removeElement($idPartner);

        return $this;
    }
}
