<?php

namespace App\Interface;

use App\Entity\Community;

interface CommunityRepositoryInterface
{
    /**
     * @param $id
     * @param null $lockMode
     * @param null $lockVersion
     * @return Community|null
     */
    public function find($id, $lockMode = null, $lockVersion = null);
}