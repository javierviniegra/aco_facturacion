<?php

namespace App\Repository;

use App\Entity\FormasPago;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FormasPago|null find($id, $lockMode = null, $lockVersion = null)
 * @method FormasPago|null findOneBy(array $criteria, array $orderBy = null)
 * @method FormasPago[]    findAll()
 * @method FormasPago[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormasPagoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FormasPago::class);
    }

    // /**
    //  * @return FormasPago[] Returns an array of FormasPago objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FormasPago
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
