<?php

namespace App\Repository;

use App\Entity\Waiter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Waiter|null find($id, $lockMode = null, $lockVersion = null)
 * @method Waiter|null findOneBy(array $criteria, array $orderBy = null)
 * @method Waiter[]    findAll()
 * @method Waiter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WaiterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Waiter::class);
    }

    // /**
    //  * @return Waiter[] Returns an array of Waiter objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Waiter
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
