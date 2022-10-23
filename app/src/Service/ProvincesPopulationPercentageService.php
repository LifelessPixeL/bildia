<?php


namespace App\Service;

use App\Interface\ProvinceRepositoryInterface;
use App\Interface\ProvincesPopulationPercentageInterface;


class ProvincesPopulationPercentageService implements ProvincesPopulationPercentageInterface
{
    public function __construct(private ProvinceRepositoryInterface $provinceRepository) {}

    public function getProvincesPopulationPercentage(array $provincesIds): float|int
    {
        $allProvincesPopulation = $this->provinceRepository->getAllProvincesPopulation();
        $provincesTotalPopulation = $this->provinceRepository->getProvincesTotalPopulation($provincesIds);

        return $this->calculatePercentage($provincesTotalPopulation, $allProvincesPopulation);
    }

    private function calculatePercentage(int $quantity, int $total): float|int
    {
        return ($quantity / $total) * 100;
    }
}