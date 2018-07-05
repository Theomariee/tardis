<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EtudiantRepository")
 * @UniqueEntity(fields="numeroEtudiant")
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
    private $numeroEtudiant;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Filiere", inversedBy="etudiants")
     */
    private $filiere;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Note", mappedBy="etudiant")
     */
    private $notes;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\AppUser", mappedBy="etudiant", cascade={"persist", "remove"})
     */
    private $appUser;

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
        return $this->numeroEtudiant;
    }

    public function setNumeroEtudiant(string $numeroEtudiant): self
    {
        $this->numeroEtudiant = $numeroEtudiant;

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

    public function getAppUser(): ?AppUser
    {
        return $this->appUser;
    }

    public function setAppUser(AppUser $appUser): self
    {
        $this->appUser = $appUser;

        // set the owning side of the relation if necessary
        if ($this !== $appUser->getEtudiant()) {
            $appUser->setEtudiant($this);
        }

        return $this;
    }
}
