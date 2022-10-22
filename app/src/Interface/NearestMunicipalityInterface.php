<?php

namespace App\Interface;

use App\Entity\Municipality;

interface NearestMunicipalityInterface
{
    /**
     * @param Municipality[]
     * @param string $cardinal
     * @return Municipality|null
     */
    public function getNearestMunicipality(array $municipalitiesIds, string $cardinal): ?Municipality;
}
