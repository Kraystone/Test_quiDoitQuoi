<?php

namespace App\Entity;

use App\Repository\SoireeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SoireeRepository::class)
 */
class Soiree
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
     * @ORM\OneToMany(targetEntity=Personne::class, mappedBy="personne_de_la_soiree")
     */
    private $personne_de_la_soiree;

    public function __construct()
    {
        $this->personne_de_la_soiree = new ArrayCollection();
    }

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

    /**
     * @return Collection|Personne[]
     */
    public function getPersonneDeLaSoiree(): Collection
    {
        return $this->personne_de_la_soiree;
    }

    public function addPersonneDeLaSoiree(Personne $personneDeLaSoiree): self
    {
        if (!$this->personne_de_la_soiree->contains($personneDeLaSoiree)) {
            $this->personne_de_la_soiree[] = $personneDeLaSoiree;
            $personneDeLaSoiree->setPersonneDeLaSoiree($this);
        }

        return $this;
    }

    public function removePersonneDeLaSoiree(Personne $personneDeLaSoiree): self
    {
        if ($this->personne_de_la_soiree->contains($personneDeLaSoiree)) {
            $this->personne_de_la_soiree->removeElement($personneDeLaSoiree);
            // set the owning side to null (unless already changed)
            if ($personneDeLaSoiree->getPersonneDeLaSoiree() === $this) {
                $personneDeLaSoiree->setPersonneDeLaSoiree(null);
            }
        }

        return $this;
    }
}
