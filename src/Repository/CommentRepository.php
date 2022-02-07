<?php

namespace App\Repository;

use App\Entity\Comment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Comment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comment[]    findAll()
 * @method Comment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comment::class);
    }

    public function averageRating(int $id): array
    {
        $queryBuilder = $this->createQueryBuilder('c')
            ->select('AVG(c.rating) as average')
            ->where('c.recipient = :id')
            ->setParameter('id', $id)
            ->groupBy('c.recipient')
            ->getQuery();

        if (!is_array($queryBuilder->getResult()) || empty($queryBuilder->getResult())) {
            return ([["average" => 3]]);
        }

        dd($queryBuilder->getResult());
        return $queryBuilder->getResult();
    }
}
