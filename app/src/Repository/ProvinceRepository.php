<?php

namespace App\Repository;

use App\Entity\Community;
use App\Entity\Province;
use App\Interface\ProvinceRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Province>
 *
 * @method Province|null find($id, $lockMode = null, $lockVersion = null)
 * @method Province|null findOneBy(array $criteria, array $orderBy = null)
 * @method Province[]    findAll()
 * @method Province[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProvinceRepository extends ServiceEntityRepository implements ProvinceRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Province::class);
    }

    /**
     * @throws NonUniqueResultException
     */
    public function getTotalPopulationByCommunityId(Community $community): array
    {
        $qb = $this->createQueryBuilder('p')
                ->andWhere('p.community = :community')
                ->setParameter('community', $community)
                ->select('SUM(p.population) as totalPopulation')
                ->getQuery();

        return $qb->getOneOrNullResult();
    }

    public function update(): void
    {
        $this->_em->flush();
    }

    /**
     * @throws NoResultException|NonUniqueResultException
     */
    public function getProvincesTotalPopulation(array $provincesIds)
    {
        $qb = $this->createQueryBuilder('p')
            ->andWhere('p.id IN (:provincesIds)')
            ->setParameter('provincesIds', implode(',', $provincesIds))
            ->select('SUM(p.population) as totalPopulation')
            ->getQuery();

        return $qb->getSingleScalarResult();
    }

    /**
     * @throws NoResultException|NonUniqueResultException
     */
    public function getAllProvincesPopulation()
    {
        $qb = $this->createQueryBuilder('p')
            ->select('SUM(p.population) as totalPopulation')
            ->getQuery();

        return $qb->getSingleScalarResult();
    }
}
