<?php

namespace App\Interface;

use App\Entity\Community;

interface LargestPopulationCommunityInterface
{
    public function getLargestPopulationCommunity(int $firstCommunityId, int $secondCommunityId): ?Community;
}
