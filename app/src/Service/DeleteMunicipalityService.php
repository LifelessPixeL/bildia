<?php

namespace App\Service;

use App\Interface\DeleteMunicipalityInterface;
use App\Interface\MunicipalityRepositoryInterface;

class DeleteMunicipalityService implements DeleteMunicipalityInterface
{
    public function __construct(
        private MunicipalityRepositoryInterface $municipalityRepository
    ) {}

    public function delete(int $municipalityId) : void
    {
        $municipality = $this->municipalityRepository->find($municipalityId);

        $this->municipalityRepository->delete($municipality);
    }
}