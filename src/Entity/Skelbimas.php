<?php

namespace App\Entity;

use App\Repository\SkelbimasRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SkelbimasRepository::class)
 */
class Skelbimas
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pavadinimas;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $aprasymas;

    /**
     * @ORM\Column(type="date")
     */
    private $pridejimo_data;

    /**
     * @ORM\Column(type="date")
     */
    private $galiojimo_pab;

    /**
     * @ORM\OneToMany(targetEntity=Zinute::class, mappedBy="skelbimas", orphanRemoval=true)
     */
    private $zinutes;

    /**
     * @ORM\ManyToOne(targetEntity=Vartotojas::class, inversedBy="skelbimai")
     * @ORM\JoinColumn(nullable=false)
     */
    private $vartotojas;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tipas;

    public function __construct()
    {
        $this->pridejimo_data = new DateTime();
        $this->zinutes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPavadinimas(): ?string
    {
        return $this->pavadinimas;
    }

    public function setPavadinimas(string $pavadinimas): self
    {
        $this->pavadinimas = $pavadinimas;

        return $this;
    }

    public function getAprasymas(): ?string
    {
        return $this->aprasymas;
    }

    public function setAprasymas(string $aprasymas): self
    {
        $this->aprasymas = $aprasymas;

        return $this;
    }

    public function getPridejimoData(): ?\DateTimeInterface
    {
        return $this->pridejimo_data;
    }

    public function setPridejimoData(\DateTimeInterface $pridejimo_data): self
    {
        $this->pridejimo_data = $pridejimo_data;

        return $this;
    }

    public function getGaliojimoPab(): ?\DateTimeInterface
    {
        return $this->galiojimo_pab;
    }

    public function setGaliojimoPab(\DateTimeInterface $galiojimo_pab): self
    {
        $this->galiojimo_pab = $galiojimo_pab;

        return $this;
    }

    /**
     * @return Collection|Zinute[]
     */
    public function getZinutes(): Collection
    {
        return $this->zinutes;
    }

    public function addZinute(Zinute $zinute): self
    {
        if (!$this->zinutes->contains($zinute)) {
            $this->zinutes[] = $zinute;
            $zinute->setSkelbimas($this);
        }

        return $this;
    }

    public function removeZinute(Zinute $zinute): self
    {
        if ($this->zinutes->removeElement($zinute)) {
            // set the owning side to null (unless already changed)
            if ($zinute->getSkelbimas() === $this) {
                $zinute->setSkelbimas(null);
            }
        }

        return $this;
    }

    public function getVartotojas(): ?Vartotojas
    {
        return $this->vartotojas;
    }

    public function setVartotojas(?Vartotojas $vartotojas): self
    {
        $this->vartotojas = $vartotojas;

        return $this;
    }

    public function __toString(): string
    {
        return (string) $this->pavadinimas;
    }

    public function getTipas(): ?string
    {
        return $this->tipas;
    }

    public function setTipas(string $tipas): self
    {
        $this->tipas = $tipas;

        return $this;
    }
}
