<?php

namespace App\Repository;

use App\Entity\TipoCamion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TipoCamion|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoCamion|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoCamion[]    findAll()
 * @method TipoCamion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoCamionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoCamion::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(TipoCamion $entity, bool $flush = true): void
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
    public function remove(TipoCamion $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return TipoCamion[] Returns an array of TipoCamion objects
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
    public function findOneBySomeField($value): ?TipoCamion
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
