<?php

namespace App\Repository;

use App\Entity\Swapper;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Swapper|null find($id, $lockMode = null, $lockVersion = null)
 * @method Swapper|null findOneBy(array $criteria, array $orderBy = null)
 * @method Swapper[]    findAll()
 * @method Swapper[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SwapperRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Swapper::class);
    }

    // /**
    //  * @return Swapper[] Returns an array of Swapper objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Swapper
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
