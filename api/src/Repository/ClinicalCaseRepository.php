<?php

namespace App\Repository;

use App\Entity\ClinicalCase;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ClinicalCase|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClinicalCase|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClinicalCase[]    findAll()
 * @method ClinicalCase[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClinicalCaseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClinicalCase::class);
    }

    // /**
    //  * @return ClinicalCase[] Returns an array of ClinicalCase objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ClinicalCase
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
