<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SemestreRepository")
 */
class Semestre
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $numeroSemestre;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Matiere", mappedBy="semestre")
     */
    private $matieres;

    public function __construct()
    {
        $this->matieres = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNumeroSemestre(): ?int
    {
        return $this->numeroSemestre;
    }

    public function setNumeroSemestre(int $numeroSemestre): self
    {
        $this->numeroSemestre = $numeroSemestre;

        return $this;
    }

    /**
     * @return Collection|Matiere[]
     */
    public function getMatieres(): Collection
    {
        return $this->matieres;
    }

    public function addMatiere(Matiere $matiere): self
    {
        if (!$this->matieres->contains($matiere)) {
            $this->matieres[] = $matiere;
            $matiere->setSemestre($this);
        }

        return $this;
    }

    public function removeMatiere(Matiere $matiere): self
    {
        if ($this->matieres->contains($matiere)) {
            $this->matieres->removeElement($matiere);
            // set the owning side to null (unless already changed)
            if ($matiere->getSemestre() === $this) {
                $matiere->setSemestre(null);
            }
        }

        return $this;
    }
}
