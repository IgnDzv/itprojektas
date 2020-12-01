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

    /**
     * @ORM\OneToMany(targetEntity=Zinute::class, mappedBy="vartotojas", orphanRemoval=true)
     */
    private $zinutes;

    /**
     * @ORM\Column(type="boolean")
     */
    private $ar_gali_deti;

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

    public function getRole(): string
    {
        return $this->roles[0];
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

    /**
     * @return Collection|Skelbimas[]
     */
    public function getZinutes(): Collection
    {
        return $this->zinutes;
    }

    public function addZinute(Zinute $zinute): self
    {
        if (!$this->zinutes->contains($zinute)) {
            $this->zinutes[] = $zinute;
            $this->zinutes->setVartotojas($this);
        }

        return $this;
    }

    public function removeZinute(Zinute $zinute): self
    {
        if ($this->zinutes->removeElement($zinute)) {
            // set the owning side to null (unless already changed)
            if ($zinute->getVartotojas() === $this) {
                $zinute->setVartotojas(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->slapyvardis;
    }

    public function getArGaliDeti(): ?bool
    {
        return $this->ar_gali_deti;
    }

    public function setArGaliDeti(bool $ar_gali_deti): self
    {
        $this->ar_gali_deti = $ar_gali_deti;

        return $this;
    }
}
