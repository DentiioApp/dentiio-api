<?php

namespace App\Repository;

use App\Entity\ImageClinicalCase;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ImageClinicalCase|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImageClinicalCase|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImageClinicalCase[]    findAll()
 * @method ImageClinicalCase[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImageClinicalCaseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImageClinicalCase::class);
    }

    // /**
    //  * @return ImageClinicalCase[] Returns an array of ImageClinicalCase objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ImageClinicalCase
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
