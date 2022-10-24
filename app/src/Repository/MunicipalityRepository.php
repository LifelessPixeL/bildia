<?php

namespace App\Repository;

use App\Entity\Municipality;
use App\Interface\MunicipalityRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Municipality>
 * 
 * @method Municipality|null find($id, $lockMode = null, $lockVersion = null)
 * @method Municipality|null findOneBy(array $criteria, array $orderBy = null)
 * @method Municipality[]    findAll()
 * @method Municipality[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MunicipalityRepository extends ServiceEntityRepository implements MunicipalityRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Municipality::class);
    }

    /**
     * {@inheritdoc}
     */
    public function findMunicipalitiesByIds(array $municipalitiesIds): ?array
    {
        $qb = $this->createQueryBuilder('m')
                ->where('m.id IN (:municipalitiesIds)')
                ->setParameter('municipalitiesIds', $municipalitiesIds)
                ->getQuery();

        return $qb->execute();
    }

    public function save(Municipality $municipality): void
    {
        $this->_em->persist($municipality);

        $this->_em->flush();
    }

    public function delete(Municipality $municipality): void
    {
        $this->_em->remove($municipality);

        $this->_em->flush();
    }
}
