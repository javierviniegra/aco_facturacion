<?php

namespace App\Repository;

use App\Entity\TipoSangre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TipoSangre|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoSangre|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoSangre[]    findAll()
 * @method TipoSangre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoSangreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoSangre::class);
    }

    // /**
    //  * @return TipoSangre[] Returns an array of TipoSangre objects
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
    public function findOneBySomeField($value): ?TipoSangre
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
