<?php

namespace App\Service;

use App\Interface\ProvinceRepositoryInterface;
use App\Interface\UpdateProvinceInterface;

class UpdateProvinceService implements UpdateProvinceInterface
{
    public function __construct(
        private ProvinceRepositoryInterface $provinceRepository,
    ) {}

    public function updateProvincePopulation(int $provinceId, int $population): void
    {
        $province = $this->provinceRepository->find($provinceId);

        $province->setPopulation($population);

        $this->provinceRepository->update();
    }
}