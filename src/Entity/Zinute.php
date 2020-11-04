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
}
