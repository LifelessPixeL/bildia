<?php

namespace App\Interface;

use App\Entity\Municipality;

interface MunicipalityRepositoryInterface
{
    /**
     * @param array $municipalitiesIds
     * @return ?Municipality[]
     */
    public function findMunicipalitiesByIds(array $municipalitiesIds): ?array;
}
