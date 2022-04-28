<?php

namespace App\Repository;

use App\Entity\FormasPagoClientes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FormasPagoClientes|null find($id, $lockMode = null, $lockVersion = null)
 * @method FormasPagoClientes|null findOneBy(array $criteria, array $orderBy = null)
 * @method FormasPagoClientes[]    findAll()
 * @method FormasPagoClientes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormasPagoClientesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FormasPagoClientes::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(FormasPagoClientes $entity, bool $flush = true): void
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
    public function remove(FormasPagoClientes $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return FormasPagoClientes[] Returns an array of FormasPagoClientes objects
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
    public function findOneBySomeField($value): ?FormasPagoClientes
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
