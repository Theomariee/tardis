<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EtudiantRepository")
 */
class Etudiant implements UserInterface, \Serializable
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
     * @ORM\Column(type="boolean")
     */
    private $activerNotifications;

    /**
     * @ORM\Column(type="string", length=127, nullable=true)
     */
    private $adresseMail;

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

    public function getActiverNotifications(): ?bool
    {
        return $this->activerNotifications;
    }

    public function setActiverNotifications(bool $activerNotifications): self
    {
        $this->activerNotifications = $activerNotifications;

        return $this;
    }

    public function getAdresseMail(): ?string
    {
        return $this->adresseMail;
    }

    public function setAdresseMail(?string $adresseMail): self
    {
        $this->adresseMail = $adresseMail;

        return $this;
    }

    public function getPassword(): ?string
    {
        return 'password';
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {
    }

    public function getUsername()
    {
        return $this->numeroEtudiant;
    }

    public function getRoles()
    {
        return array('ROLE_USER');
    }

    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->numeroEtudiant,
            'password',
        ));
    }

    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->numeroEtudiant,
        ) = unserialize($serialized, array('allowed_classes' => false));
    }
}
