<?php

namespace App\Service;

use App\Interface\GetMunicipalitiesInterface;
use App\Interface\MunicipalityRepositoryInterface;

class GetMunicipalitiesService implements GetMunicipalitiesInterface
{
    public function __construct(
        private MunicipalityRepositoryInterface $municipalityRepository
    ) {}

    public function getMunicipalities(): array
    {
        $municipalities = [];
        foreach ($this->municipalityRepository->findAll() as $municipality) {
            $municipalities[] = [
                'id' => $municipality->getId(),
                'name' => $municipality->getName(),
                'latitude' => $municipality->getLatitude(),
                'longitude' => $municipality->getLongitude(),
            ];
        }

        return $municipalities;
    }
}