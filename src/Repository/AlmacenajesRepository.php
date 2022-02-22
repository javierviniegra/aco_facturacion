<?php

namespace App\Repository;

use App\Entity\Almacenajes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Almacenajes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Almacenajes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Almacenajes[]    findAll()
 * @method Almacenajes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlmacenajesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Almacenajes::class);
    }

    // /**
    //  * @return Almacenajes[] Returns an array of Almacenajes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Almacenajes
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
