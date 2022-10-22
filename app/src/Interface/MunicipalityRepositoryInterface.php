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

    public function find(int $municipalityId);

    /**
     * @return ?Municipality[]
     */
    public function findAll();
}
