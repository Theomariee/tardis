<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EtudiantRepository")
 */
class Etudiant
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=8)
     */
    private $numero_etudiant;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Filiere", inversedBy="etudiants")
     */
    private $filiere;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Note", mappedBy="etudiant")
     */
    private $notes;

    public function __construct()
    {
        $this->filiere = new ArrayCollection();
        $this->notes = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNumeroEtudiant(): ?string
    {
        return $this->numero_etudiant;
    }

    public function setNumeroEtudiant(string $numero_etudiant): self
    {
        $this->numero_etudiant = $numero_etudiant;

        return $this;
    }

    /**
     * @return Collection|Filiere[]
     */
    public function getFiliere(): Collection
    {
        return $this->filiere;
    }

    public function addFiliere(Filiere $filiere): self
    {
        if (!$this->filiere->contains($filiere)) {
            $this->filiere[] = $filiere;
        }

        return $this;
    }

    public function removeFiliere(Filiere $filiere): self
    {
        if ($this->filiere->contains($filiere)) {
            $this->filiere->removeElement($filiere);
        }

        return $this;
    }

    /**
     * @return Collection|Note[]
     */
    public function getNotes(): Collection
    {
        return $this->notes;
    }

    public function addNote(Note $note): self
    {
        if (!$this->notes->contains($note)) {
            $this->notes[] = $note;
            $note->setEtudiant($this);
        }

        return $this;
    }

    public function removeNote(Note $note): self
    {
        if ($this->notes->contains($note)) {
            $this->notes->removeElement($note);
            // set the owning side to null (unless already changed)
            if ($note->getEtudiant() === $this) {
                $note->setEtudiant(null);
            }
        }

        return $this;
    }
}
