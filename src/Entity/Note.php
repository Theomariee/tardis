<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NoteRepository")
 */
class Note
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Matiere", inversedBy="notes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $matiere;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Etudiant", inversedBy="notes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $etudiant;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeCc", inversedBy="notes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeCc;

    /**
     * @ORM\Column(type="float")
     */
    private $note;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_publication;

    public function getId()
    {
        return $this->id;
    }

    public function getMatiere(): ?Matiere
    {
        return $this->matiere;
    }

    public function setMatiere(?Matiere $matiere): self
    {
        $this->matiere = $matiere;

        return $this;
    }

    public function getEtudiant(): ?Etudiant
    {
        return $this->etudiant;
    }

    public function setEtudiant(?Etudiant $etudiant): self
    {
        $this->etudiant = $etudiant;

        return $this;
    }

    public function getTypeCc(): ?TypeCc
    {
        return $this->typeCc;
    }

    public function setTypeCc(?TypeCc $typeCc): self
    {
        $this->typeCc = $typeCc;

        return $this;
    }

    public function getNote(): ?float
    {
        return $this->note;
    }

    public function setNote(float $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getDatePublication(): ?\DateTimeInterface
    {
        return $this->date_publication;
    }

    public function setDatePublication(\DateTimeInterface $date_publication): self
    {
        $this->date_publication = $date_publication;

        return $this;
    }
}
