<?php

namespace App\Interface;

use App\Entity\Community;

interface ProvinceRepositoryInterface
{
    public function getTotalPopulationByCommunityId(Community $community): array;

    public function update();
}
