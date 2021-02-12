<?php

namespace App\Repository;

use App\Entity\ClinicalCaseOmnipratique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ClinicalCaseOmnipratique|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClinicalCaseOmnipratique|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClinicalCaseOmnipratique[]    findAll()
 * @method ClinicalCaseOmnipratique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClinicalCaseOmnipratiqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClinicalCaseOmnipratique::class);
    }

    // /**
    //  * @return ClinicalCaseOmnipratique[] Returns an array of ClinicalCaseOmnipratique objects
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
    public function findOneBySomeField($value): ?ClinicalCaseOmnipratique
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
