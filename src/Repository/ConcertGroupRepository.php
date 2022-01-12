<?php

namespace App\Repository;

use App\Entity\ConcertGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ConcertGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConcertGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConcertGroup[]    findAll()
 * @method ConcertGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConcertGroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConcertGroup::class);
    }

    // /**
    //  * @return ConcertGroup[] Returns an array of ConcertGroup objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ConcertGroup
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
