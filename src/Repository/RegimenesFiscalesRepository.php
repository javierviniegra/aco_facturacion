<?php

namespace App\Repository;

use App\Entity\RegimenesFiscales;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RegimenesFiscales|null find($id, $lockMode = null, $lockVersion = null)
 * @method RegimenesFiscales|null findOneBy(array $criteria, array $orderBy = null)
 * @method RegimenesFiscales[]    findAll()
 * @method RegimenesFiscales[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RegimenesFiscalesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RegimenesFiscales::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(RegimenesFiscales $entity, bool $flush = true): void
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
    public function remove(RegimenesFiscales $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return RegimenesFiscales[] Returns an array of RegimenesFiscales objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RegimenesFiscales
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
