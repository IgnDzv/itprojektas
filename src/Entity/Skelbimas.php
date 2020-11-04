<?php

namespace App\Entity;

use App\Repository\SkelbimasRepository;
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
}
