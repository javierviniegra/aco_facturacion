<?php

namespace App\Repository;

use App\Entity\TiposLicencia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TiposLicencia|null find($id, $lockMode = null, $lockVersion = null)
 * @method TiposLicencia|null findOneBy(array $criteria, array $orderBy = null)
 * @method TiposLicencia[]    findAll()
 * @method TiposLicencia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TiposLicenciaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TiposLicencia::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(TiposLicencia $entity, bool $flush = true): void
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
    public function remove(TiposLicencia $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return TiposLicencia[] Returns an array of TiposLicencia objects
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
    public function findOneBySomeField($value): ?TiposLicencia
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
