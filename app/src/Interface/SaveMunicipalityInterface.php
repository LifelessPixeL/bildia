<?php

namespace App\Interface;

interface SaveMunicipalityInterface
{
    public function saveMunicipality(string $slug, string $name, string $latitude, string $longitude): void;
}