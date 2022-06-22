<?php

namespace App\Repository;

use App\Entity\SegurosAuto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SegurosAuto|null find($id, $lockMode = null, $lockVersion = null)
 * @method SegurosAuto|null findOneBy(array $criteria, array $orderBy = null)
 * @method SegurosAuto[]    findAll()
 * @method SegurosAuto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SegurosAutoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SegurosAuto::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(SegurosAuto $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(SegurosAuto $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return SegurosAuto[] Returns an array of SegurosAuto objects
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
    public function findOneBySomeField($value): ?SegurosAuto
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
