<?php

namespace App\Repository;

use App\Entity\Sonatausruser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Sonatausruser|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sonatausruser|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sonatausruser[]    findAll()
 * @method Sonatausruser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SonatausruserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sonatausruser::class);
    }

    // /**
    //  * @return Sonatausruser[] Returns an array of Sonatausruser objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Sonatausruser
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
