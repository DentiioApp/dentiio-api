<?php

namespace App\Repository;

use App\Entity\ImageClinicalCaseType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ImageClinicalCaseType|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImageClinicalCaseType|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImageClinicalCaseType[]    findAll()
 * @method ImageClinicalCaseType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImageClinicalCaseTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImageClinicalCaseType::class);
    }

    // /**
    //  * @return ImageClinicalCaseType[] Returns an array of ImageClinicalCaseType objects
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
    public function findOneBySomeField($value): ?ImageClinicalCaseType
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
