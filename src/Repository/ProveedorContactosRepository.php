<?php

namespace App\Repository;

use App\Entity\ProveedorContactos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProveedorContactos|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProveedorContactos|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProveedorContactos[]    findAll()
 * @method ProveedorContactos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProveedorContactosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProveedorContactos::class);
    }

    // /**
    //  * @return ProveedorContactos[] Returns an array of ProveedorContactos objects
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
    public function findOneBySomeField($value): ?ProveedorContactos
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
