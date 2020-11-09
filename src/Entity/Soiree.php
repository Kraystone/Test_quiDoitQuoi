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
     * @ORM\OneToMany(targetEntity=Personne::class, mappedBy="soiree")
     */
    private $soiree;

    public function __construct()
    {
        $this->soiree = new ArrayCollection();
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
    public function getSoiree(): Collection
    {
        return $this->soiree;
    }

    public function addSoiree(Personne $soiree): self
    {
        if (!$this->soiree->contains($soiree)) {
            $this->soiree[] = $soiree;
            $soiree->setSoiree($this);
        }

        return $this;
    }

    public function removeSoiree(Personne $soiree): self
    {
        if ($this->soiree->contains($soiree)) {
            $this->soiree->removeElement($soiree);
            // set the owning side to null (unless already changed)
            if ($soiree->getSoiree() === $this) {
                $soiree->setSoiree(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return "some string representation of your object";
    }
}
