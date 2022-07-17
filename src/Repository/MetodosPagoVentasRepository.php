<?php

namespace App\Repository;

use App\Entity\MetodosPagoVentas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MetodosPagoVentas|null find($id, $lockMode = null, $lockVersion = null)
 * @method MetodosPagoVentas|null findOneBy(array $criteria, array $orderBy = null)
 * @method MetodosPagoVentas[]    findAll()
 * @method MetodosPagoVentas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MetodosPagoVentasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MetodosPagoVentas::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(MetodosPagoVentas $entity, bool $flush = true): void
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
    public function remove(MetodosPagoVentas $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return MetodosPagoVentas[] Returns an array of MetodosPagoVentas objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MetodosPagoVentas
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
