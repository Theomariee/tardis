<?php

namespace App\Repository;

use App\Entity\Evenement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Evenement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Evenement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Evenement[]    findAll()
 * @method Evenement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EvenementRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Evenement::class);
    }

    public function getEvenementsFiliere($idFiliere) {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            select evenement.id 
            from evenement
            inner join matiere_filiere
            on evenement.matiere_id = matiere_filiere.matiere_id
            where matiere_filiere.filiere_id = :idFiliere
        ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['idFiliere' => $idFiliere]);

        // returns an array of arrays (i.e. a raw data set)
        return array_column($stmt->fetchAll(), "id");
    }
}
