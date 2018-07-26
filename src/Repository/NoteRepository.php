<?php

namespace App\Repository;

use App\Entity\Note;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Note|null find($id, $lockMode = null, $lockVersion = null)
 * @method Note|null findOneBy(array $criteria, array $orderBy = null)
 * @method Note[]    findAll()
 * @method Note[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NoteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Note::class);
    }

    public function getMeilleureNote($idMatiere, $idTypeCc) {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            select max(note) as meilleurenote
            from note
            where matiere_id = :idMatiere
            and type_cc_id = :idTypeCc
        ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['idMatiere' => $idMatiere, 'idTypeCc' => $idTypeCc]);

        $tResult = $stmt->fetch();
        return $tResult['meilleurenote'];
    }

    public function getNoteMoyenne($idMatiere, $idTypeCc) {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            select avg(note) as moyenne
            from note
            where matiere_id = :idMatiere
            and type_cc_id = :idTypeCc
        ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['idMatiere' => $idMatiere, 'idTypeCc' => $idTypeCc]);

        $tResult = $stmt->fetch();
        return $tResult['moyenne'];
    }
}
