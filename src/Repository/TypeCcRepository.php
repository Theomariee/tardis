<?php

namespace App\Repository;

use App\Entity\TypeCc;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TypeCc|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeCc|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeCc[]    findAll()
 * @method TypeCc[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeCcRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TypeCc::class);
    }

//    /**
//     * @return TypeCc[] Returns an array of TypeCc objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeCc
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
