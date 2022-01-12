<?php

namespace App\Repository;

use App\Entity\ConcertTicketOffice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ConcertTicketOffice|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConcertTicketOffice|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConcertTicketOffice[]    findAll()
 * @method ConcertTicketOffice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConcertTicketOfficeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConcertTicketOffice::class);
    }

    // /**
    //  * @return ConcertTicketOffice[] Returns an array of ConcertTicketOffice objects
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
    public function findOneBySomeField($value): ?ConcertTicketOffice
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
