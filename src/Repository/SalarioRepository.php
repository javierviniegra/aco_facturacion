<?php

namespace App\Repository;

use App\Entity\Salario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Salario|null find($id, $lockMode = null, $lockVersion = null)
 * @method Salario|null findOneBy(array $criteria, array $orderBy = null)
 * @method Salario[]    findAll()
 * @method Salario[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SalarioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Salario::class);
    }

    // /**
    //  * @return Salario[] Returns an array of Salario objects
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
    public function findOneBySomeField($value): ?Salario
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
