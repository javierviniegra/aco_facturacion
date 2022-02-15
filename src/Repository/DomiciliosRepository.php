<?php

namespace App\Repository;

use App\Entity\Domicilios;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Domicilios|null find($id, $lockMode = null, $lockVersion = null)
 * @method Domicilios|null findOneBy(array $criteria, array $orderBy = null)
 * @method Domicilios[]    findAll()
 * @method Domicilios[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DomiciliosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Domicilios::class);
    }

    // /**
    //  * @return Domicilios[] Returns an array of Domicilios objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Domicilios
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
