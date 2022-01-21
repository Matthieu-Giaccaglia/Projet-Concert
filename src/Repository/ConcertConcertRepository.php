<?php

namespace App\Repository;

use App\Entity\ConcertConcert;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ConcertConcert|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConcertConcert|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConcertConcert[]    findAll()
 * @method ConcertConcert[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConcertConcertRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConcertConcert::class);
    }

    /**
     * Get the next concert of specific group.
     *
     * @param string|int $idGroup id of the group.
     * @return ConcertConcert[] Returns an array of ConcertConcert objects
     */
    public function getNextGroupConcert($idGroup): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.concertGroup = :val')
            ->andWhere('c.datetimeBegin > :dateBegin')
            ->setParameter('val', $idGroup)
            ->setParameter('dateBegin', date('Y-m-d h:i:s'))
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * Get the next concert of specific group.
     *
     * @return ConcertConcert[] Returns an array of ConcertConcert objects
     */
    public function getNextConcert(): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.datetimeBegin > :dateBegin')
            ->setParameter('dateBegin', date('Y-m-d h:i:s'))
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }

    // /**
    //  * @return ConcertConcert[] Returns an array of ConcertConcert objects
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
    public function findOneBySomeField($value): ?ConcertConcert
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
