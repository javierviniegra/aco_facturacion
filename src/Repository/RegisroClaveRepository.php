<?php

namespace App\Repository;

use App\Entity\RegisroClave;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RegisroClave|null find($id, $lockMode = null, $lockVersion = null)
 * @method RegisroClave|null findOneBy(array $criteria, array $orderBy = null)
 * @method RegisroClave[]    findAll()
 * @method RegisroClave[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RegisroClaveRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RegisroClave::class);
    }

    // /**
    //  * @return RegisroClave[] Returns an array of RegisroClave objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RegisroClave
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
