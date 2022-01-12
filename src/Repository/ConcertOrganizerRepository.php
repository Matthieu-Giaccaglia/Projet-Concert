<?php

namespace App\Repository;

use App\Entity\ConcertOrganizer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ConcertOrganizer|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConcertOrganizer|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConcertOrganizer[]    findAll()
 * @method ConcertOrganizer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConcertOrganizerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConcertOrganizer::class);
    }

    // /**
    //  * @return ConcertOrganizer[] Returns an array of ConcertOrganizer objects
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
    public function findOneBySomeField($value): ?ConcertOrganizer
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
