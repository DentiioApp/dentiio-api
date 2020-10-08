<?php

namespace App\Repository;

use App\Entity\CategoriePathologie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CategoriePathologie|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoriePathologie|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoriePathologie[]    findAll()
 * @method CategoriePathologie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoriePathologieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoriePathologie::class);
    }

    // /**
    //  * @return CategoriePathologie[] Returns an array of CategoriePathologie objects
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
    public function findOneBySomeField($value): ?CategoriePathologie
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
