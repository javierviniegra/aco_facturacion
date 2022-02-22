<?php

namespace App\Repository;

use App\Entity\Bancos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Bancos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bancos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bancos[]    findAll()
 * @method Bancos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BancosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bancos::class);
    }

    // /**
    //  * @return Bancos[] Returns an array of Bancos objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bancos
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
