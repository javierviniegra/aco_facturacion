<?php

namespace App\Repository;

use App\Entity\TipoDomicilio;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TipoDomicilio|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoDomicilio|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoDomicilio[]    findAll()
 * @method TipoDomicilio[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoDomicilioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoDomicilio::class);
    }

    // /**
    //  * @return TipoDomicilio[] Returns an array of TipoDomicilio objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TipoDomicilio
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
