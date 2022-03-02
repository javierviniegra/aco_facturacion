<?php

namespace App\Repository;

use App\Entity\ProductosVenta;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProductosVenta|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductosVenta|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductosVenta[]    findAll()
 * @method ProductosVenta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductosVentaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductosVenta::class);
    }

    // /**
    //  * @return ProductosVenta[] Returns an array of ProductosVenta objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProductosVenta
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
