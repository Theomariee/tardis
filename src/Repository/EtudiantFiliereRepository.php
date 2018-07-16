<?php

namespace App\Repository;

use App\Entity\EtudiantFiliere;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method EtudiantFiliere|null find($id, $lockMode = null, $lockVersion = null)
 * @method EtudiantFiliere|null findOneBy(array $criteria, array $orderBy = null)
 * @method EtudiantFiliere[]    findAll()
 * @method EtudiantFiliere[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtudiantFiliereRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, EtudiantFiliere::class);
    }

    /**
     * @param idEtudiant
     * @return Filiere
     */
    public function getFiliereActuelle($idEtudiant)
    {
        $qb = $this->createQueryBuilder('f')
            ->andWhere('f.date <= :dateactuelle')
            ->andWhere('f.etudiant <= :idetudiant')
            ->setParameter('dateactuelle', new \DateTime())
            ->setParameter('idetudiant', $idEtudiant)
            ->orderBy('f.date', 'DESC')
            ->getQuery()
            ->getOneOrNullResult();

        return $qb;
    }
}
