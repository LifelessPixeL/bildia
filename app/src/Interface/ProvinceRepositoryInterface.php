<?php

namespace App\Interface;

use App\Entity\Community;

interface ProvinceRepositoryInterface
{
    public function getTotalPopulationByCommunityId(Community $community): array;

    public function update();

    /**
     * @param int[] $provincesIds
     */
    public function getProvincesTotalPopulation(array $provincesIds);

    public function getAllProvincesPopulation();
}
