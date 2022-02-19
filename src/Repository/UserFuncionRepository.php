<?php

namespace App\Repository;

use App\Entity\UserFuncion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserFuncion|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserFuncion|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserFuncion[]    findAll()
 * @method UserFuncion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserFuncionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserFuncion::class);
    }

    // /**
    //  * @return UserFuncion[] Returns an array of UserFuncion objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserFuncion
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
