<?php


namespace App\Interface;

interface DeleteMunicipalityInterface
{
    public function delete(int $municipalityId): void;
}