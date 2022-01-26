<?php

namespace App\Repository;

use App\Entity\Swap;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Swap|null find($id, $lockMode = null, $lockVersion = null)
 * @method Swap|null findOneBy(array $criteria, array $orderBy = null)
 * @method Swap[]    findAll()
 * @method Swap[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SwapRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Swap::class);
    }
}
