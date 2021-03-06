<?php

namespace App\Entity;

use App\Repository\ZinuteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ZinuteRepository::class)
 */
class Zinute
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
    private $tekstas;

    /**
     * @ORM\Column(type="date")
     */
    private $data;

    /**
     * @ORM\ManyToOne(targetEntity=Skelbimas::class, inversedBy="skelbimai")
     * @ORM\JoinColumn(nullable=false)
     */
    private $skelbimas;

    /**
     * @ORM\ManyToOne(targetEntity=Vartotojas::class, inversedBy="zinutes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $vartotojas;

    public function __construct()
    {
        $this->data = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTekstas(): ?string
    {
        return $this->tekstas;
    }

    public function setTekstas(string $tekstas): self
    {
        $this->tekstas = $tekstas;

        return $this;
    }

    public function getData(): ?\DateTimeInterface
    {
        return $this->data;
    }

    public function setData(\DateTimeInterface $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function getSkelbimas(): ?Skelbimas
    {
        return $this->skelbimas;
    }

    public function setSkelbimas(?Skelbimas $skelbimas): self
    {
        $this->skelbimas = $skelbimas;

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
}
