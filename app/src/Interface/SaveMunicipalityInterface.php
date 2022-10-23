<?php

namespace App\Interface;

interface SaveMunicipalityInterface
{
    public function saveMunicipality(string $slug, string $name, float $latitude, float $longitude, int $provinceId): void;
}