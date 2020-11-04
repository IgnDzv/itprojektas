<?php

namespace App\Entity;

use App\Repository\VartotojasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=VartotojasRepository::class)
 */
class Vartotojas implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $slapyvardis;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity=Skelbimas::class, mappedBy="vartotojas", orphanRemoval=true)
     */
    private $skelbimai;

    public function __construct()
    {
        $this->skelbimai = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlapyvardis(): ?string
    {
        return $this->slapyvardis;
    }

    public function setSlapyvardis(string $slapyvardis): self
    {
        $this->slapyvardis = $slapyvardis;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->slapyvardis;
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

    /**
     * @return Collection|Skelbimas[]
     */
    public function getSkelbimai(): Collection
    {
        return $this->skelbimai;
    }

    public function addSkelbimai(Skelbimas $skelbimai): self
    {
        if (!$this->skelbimai->contains($skelbimai)) {
            $this->skelbimai[] = $skelbimai;
            $skelbimai->setVartotojas($this);
        }

        return $this;
    }

    public function removeSkelbimai(Skelbimas $skelbimai): self
    {
        if ($this->skelbimai->removeElement($skelbimai)) {
            // set the owning side to null (unless already changed)
            if ($skelbimai->getVartotojas() === $this) {
                $skelbimai->setVartotojas(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->slapyvardis;
    }
}
