<?php

namespace App\Repository;

use App\Entity\Functions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Functions|null find($id, $lockMode = null, $lockVersion = null)
 * @method Functions|null findOneBy(array $criteria, array $orderBy = null)
 * @method Functions[]    findAll()
 * @method Functions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FunctionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Functions::class);
    }

    // /**
    //  * @return Functions[] Returns an array of Functions objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Functions
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
