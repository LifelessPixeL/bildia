<?php

namespace App\Repository;

use App\Entity\Community;
use App\Interface\CommunityRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Community>
 *
 * @method Community|null find($id, $lockMode = null, $lockVersion = null)
 * @method Community|null findOneBy(array $criteria, array $orderBy = null)
 * @method Community[]    findAll()
 * @method Community[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommunityRepository extends ServiceEntityRepository implements CommunityRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Community::class);
    }
}