<?php

namespace App\Interface;

interface UpdateProvinceInterface
{
    public function updateProvincePopulation(int $provinceId, int $population): void;
}