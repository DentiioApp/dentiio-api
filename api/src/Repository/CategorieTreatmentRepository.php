<?php

namespace App\Repository;

use App\Entity\CategorieTreatment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CategorieTreatment|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategorieTreatment|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategorieTreatment[]    findAll()
 * @method CategorieTreatment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieTreatmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategorieTreatment::class);
    }

    // /**
    //  * @return CategorieTreatment[] Returns an array of CategorieTreatment objects
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
    public function findOneBySomeField($value): ?CategorieTreatment
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
