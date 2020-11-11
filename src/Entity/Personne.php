<?php

namespace App\Entity;

use App\Repository\PersonneRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PersonneRepository::class)
 */
class Personne
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
    private $nom;

    /**
     * @ORM\Column(type="integer")
     */
    private $argent;

    /**
     * @ORM\ManyToOne(targetEntity=Soiree::class, inversedBy="id_personne")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_soiree;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getArgent(): ?int
    {
        return $this->argent;
    }

    public function setArgent(int $argent): self
    {
        $this->argent = $argent;

        return $this;
    }

    public function getIdSoiree(): ?Soiree
    {
        return $this->id_soiree;
    }

    public function setIdSoiree(?Soiree $id_soiree): self
    {
        $this->id_soiree = $id_soiree;

        return $this;
    }
}
