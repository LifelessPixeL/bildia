<?php

namespace App\Service;

use App\Entity\Community;
use App\Interface\CommunityRepositoryInterface;
use App\Interface\ProvinceRepositoryInterface;
use App\Interface\LargestPopulationCommunityInterface;

class LargestPopulationCommunityService implements LargestPopulationCommunityInterface
{
    public function __construct(
        private ProvinceRepositoryInterface $provinceRepository,
        private CommunityRepositoryInterface $communityRepository
    ) {}

    public function getLargestPopulationCommunity(int $firstCommunityId, int $secondCommunityId): ?Community
    {
        $firstCommunity = $this->communityRepository->find($firstCommunityId);
        $secondCommunity = $this->communityRepository->find($secondCommunityId);

        $populationFirstCommunity = $this->provinceRepository->getTotalPopulationByCommunityId($firstCommunity);
        $populationSecondCommunity = $this->provinceRepository->getTotalPopulationByCommunityId($secondCommunity);

        return
            $populationFirstCommunity['totalPopulation'] > $populationSecondCommunity['totalPopulation'] ?
                $firstCommunity :
                $secondCommunity;
    }
}