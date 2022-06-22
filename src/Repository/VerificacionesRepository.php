<?php

namespace App\Repository;

use App\Entity\Verificaciones;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Verificaciones|null find($id, $lockMode = null, $lockVersion = null)
 * @method Verificaciones|null findOneBy(array $criteria, array $orderBy = null)
 * @method Verificaciones[]    findAll()
 * @method Verificaciones[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VerificacionesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Verificaciones::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Verificaciones $entity, bool $flush = true): void
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
    public function remove(Verificaciones $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Verificaciones[] Returns an array of Verificaciones objects
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
    public function findOneBySomeField($value): ?Verificaciones
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
