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
     * @ORM\Column(type="string", length=30)
     */
    private $nom;

    /**
     * @ORM\Column(type="integer")
     */
    private $argent;

    /**
     * @ORM\ManyToOne(targetEntity=Soiree::class, inversedBy="personne_de_la_soiree")
     */
    private $personne_de_la_soiree;

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

    public function getPersonneDeLaSoiree(): ?Soiree
    {
        return $this->personne_de_la_soiree;
    }

    public function setPersonneDeLaSoiree(?Soiree $personne_de_la_soiree): self
    {
        $this->personne_de_la_soiree = $personne_de_la_soiree;

        return $this;
    }
}
