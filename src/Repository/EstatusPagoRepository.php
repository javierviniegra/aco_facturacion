<?php

namespace App\Repository;

use App\Entity\EstatusPago;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EstatusPago|null find($id, $lockMode = null, $lockVersion = null)
 * @method EstatusPago|null findOneBy(array $criteria, array $orderBy = null)
 * @method EstatusPago[]    findAll()
 * @method EstatusPago[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstatusPagoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EstatusPago::class);
    }

    // /**
    //  * @return EstatusPago[] Returns an array of EstatusPago objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EstatusPago
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
