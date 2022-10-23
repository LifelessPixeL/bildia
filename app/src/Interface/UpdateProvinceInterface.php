<?php


namespace App\Service;


interface UpdateProvinceInterface
{
    public function updateProvincePopulation(int $provinceId, int $population): void;
}