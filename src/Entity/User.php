<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]

    #[ORM\Column]
    private ?int $id = null;
    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    /**
     * @var string The hashed password
     */
    #[ORM\Column (nullable: true)]
    private ?string $password = null;
    #[ORM\Column(length: 100, nullable: true)]
    private ?string $name = null;
    #[ORM\Column(length: 100, nullable: true)]
    private ?string $address = null;
    #[ORM\Column(nullable: true)]
    private ?bool $activated = false;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'users')]
    #[ORM\JoinColumn(onDelete:'CASCADE')]
    private ?self $parent = null;
    #[ORM\OneToMany(mappedBy: 'parent', targetEntity: self::class)]
    private Collection $users;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\OneToMany(mappedBy: 'patnerParent', targetEntity: GlobalOption::class)]
    private Collection $globalOptions;

    #[ORM\OneToMany(mappedBy: 'structureParent', targetEntity: Option::class)]
    private Collection $options;

    public function __construct()
    {
        $this->globalOptions = new ArrayCollection();
        $this->options = new ArrayCollection();
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



    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }




    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }


    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;
        return $this;
    }

    public function isActivated(): ?bool
    {
        return $this->activated;
    }

    public function setActivated(?bool $activated): self
    {
        $this->activated = $activated;
        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(self $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setParent($this);
        }

        return $this;
    }

    public function removeUser(self $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getParent() === $this) {
                $user->setParent(null);
            }
        }

        return $this;
    }


    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_STRUCTURE';

        return array_unique($roles);
    }
    
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }

    /**
     * @return Collection<int, GlobalOption>
     */
    public function getGlobalOptions(): Collection
    {
        return $this->globalOptions;
    }

    public function addGlobalOption(GlobalOption $globalOption): self
    {
        if (!$this->globalOptions->contains($globalOption)) {
            $this->globalOptions->add($globalOption);
            $globalOption->setPatnerParent($this);
        }

        return $this;
    }

    public function removeGlobalOption(GlobalOption $globalOption): self
    {
        if ($this->globalOptions->removeElement($globalOption)) {
            // set the owning side to null (unless already changed)
            if ($globalOption->getPatnerParent() === $this) {
                $globalOption->setPatnerParent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Option>
     */
    public function getOptions(): Collection
    {
        return $this->options;
    }

    public function addOption(Option $option): self
    {
        if (!$this->options->contains($option)) {
            $this->options->add($option);
            $option->setStructureParent($this);
        }

        return $this;
    }

    public function removeOption(Option $option): self
    {
        if ($this->options->removeElement($option)) {
            // set the owning side to null (unless already changed)
            if ($option->getStructureParent() === $this) {
                $option->setStructureParent(null);
            }
        }

        return $this;
    }
}








