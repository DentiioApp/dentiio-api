<?php

namespace App\Repository;

use App\Entity\LogConnexion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LogConnexion|null find($id, $lockMode = null, $lockVersion = null)
 * @method LogConnexion|null findOneBy(array $criteria, array $orderBy = null)
 * @method LogConnexion[]    findAll()
 * @method LogConnexion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LogConnexionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LogConnexion::class);
    }

    // /**
    //  * @return LogConnexion[] Returns an array of LogConnexion objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LogConnexion
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
