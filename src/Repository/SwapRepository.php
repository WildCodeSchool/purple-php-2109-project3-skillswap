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

    public function getSwapDashboard(int $skill, int $partner, int $user): array
    {
        $queryBuilder = $this->createQueryBuilder('s')
            ->select('s')
            ->where('s.skill = :skill AND (
                (s.asker = :partner AND s.helper = :user)
                OR
                (s.asker = :user AND s.helper = :partner)
                )')
            ->setParameter('skill', $skill)
            ->setParameter('partner', $partner)
            ->setParameter('user', $user)
            ->orderBy('s.date', 'DESC')
            ->getQuery();

        if (!is_array($queryBuilder->getResult())) {
            return([]);
        }

        return $queryBuilder->getResult();
    }
}
