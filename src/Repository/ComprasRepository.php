<?php

namespace App\Repository;

use App\Entity\Compras;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Compras|null find($id, $lockMode = null, $lockVersion = null)
 * @method Compras|null findOneBy(array $criteria, array $orderBy = null)
 * @method Compras[]    findAll()
 * @method Compras[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComprasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Compras::class);
    }

    // /**
    //  * @return Compras[] Returns an array of Compras objects
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
    public function findOneBySomeField($value): ?Compras
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
