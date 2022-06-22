<?php

namespace App\Repository;

use App\Entity\InventariosInfraestructura;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method InventariosInfraestructura|null find($id, $lockMode = null, $lockVersion = null)
 * @method InventariosInfraestructura|null findOneBy(array $criteria, array $orderBy = null)
 * @method InventariosInfraestructura[]    findAll()
 * @method InventariosInfraestructura[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InventariosInfraestructuraRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InventariosInfraestructura::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(InventariosInfraestructura $entity, bool $flush = true): void
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
    public function remove(InventariosInfraestructura $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return InventariosInfraestructura[] Returns an array of InventariosInfraestructura objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InventariosInfraestructura
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
