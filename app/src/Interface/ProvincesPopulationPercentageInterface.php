<?php

namespace App\Interface;

interface ProvincesPopulationPercentageInterface
{
    /**
     * @param int[] $provincesIds
     */
    public function getProvincesPopulationPercentage(array $provincesIds): float|int;
}