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
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Personne::class, mappedBy="id_soiree")
     */
    private $id_personne;

    public function __construct()
    {
        $this->id_personne = new ArrayCollection();
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
    public function getIdPersonne(): Collection
    {
        return $this->id_personne;
    }

    public function addIdPersonne(Personne $idPersonne): self
    {
        if (!$this->id_personne->contains($idPersonne)) {
            $this->id_personne[] = $idPersonne;
            $idPersonne->setIdSoiree($this);
        }

        return $this;
    }

    public function removeIdPersonne(Personne $idPersonne): self
    {
        if ($this->id_personne->removeElement($idPersonne)) {
            // set the owning side to null (unless already changed)
            if ($idPersonne->getIdSoiree() === $this) {
                $idPersonne->setIdSoiree(null);
            }
        }

        return $this;
    }
}
