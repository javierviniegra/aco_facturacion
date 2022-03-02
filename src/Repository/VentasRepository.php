<?php

namespace App\Repository;

use App\Entity\Ventas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ventas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ventas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ventas[]    findAll()
 * @method Ventas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VentasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ventas::class);
    }

    // /**
    //  * @return Ventas[] Returns an array of Ventas objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ventas
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
