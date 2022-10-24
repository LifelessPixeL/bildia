<?php

namespace App\Interface;

use App\Entity\Municipality;

interface GetMunicipalitiesInterface
{
    public function getMunicipalities();

    public function getMunicipality(int $municipalityId): Municipality;
}
