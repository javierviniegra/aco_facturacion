<?php

namespace App\Repository;

use App\Entity\ClienteContactos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ClienteContactos|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClienteContactos|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClienteContactos[]    findAll()
 * @method ClienteContactos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClienteContactosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClienteContactos::class);
    }

    // /**
    //  * @return ClienteContactos[] Returns an array of ClienteContactos objects
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
    public function findOneBySomeField($value): ?ClienteContactos
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
