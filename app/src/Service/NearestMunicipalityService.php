<?php

namespace App\Service;

use App\Entity\Municipality;
use App\Interface\MunicipalityRepositoryInterface;
use App\Interface\NearestMunicipalityInterface;

class NearestMunicipalityService implements NearestMunicipalityInterface
{
    CONST CARDINAL_NORTH = 'n';
    CONST CARDINAL_SOUTH = 's';
    CONST CARDINAL_EAST = 'e';
    CONST CARDINAL_WEST = 'w';

    public function __construct(private MunicipalityRepositoryInterface $municipalityRepository) {}

    /**
     * {@inheritdoc}
     */
    public function getNearestMunicipality(array $municipalitiesIds, string $cardinal): ?Municipality
    {
        $municipalities = $this->municipalityRepository->findMunicipalitiesByIds($municipalitiesIds);

        $nearestMunicipality = null;

        switch ($cardinal) {
            case self::CARDINAL_NORTH:
                $nearestMunicipality = $this->getNearestMunicipalityNorth($municipalities);

                break;

            case self::CARDINAL_SOUTH:
                $nearestMunicipality = $this->getNearestMunicipalitySouth($municipalities);

                break;

            case self::CARDINAL_EAST:
                $nearestMunicipality = $this->getNearestMunicipalityEast($municipalities);

                break;

            case self::CARDINAL_WEST:
                $nearestMunicipality = $this->getNearestMunicipalityWest($municipalities);

                break;
        }

        return $nearestMunicipality;
    }

    /**
     * @param Municipality[]
     * @return Municipality
     */
    private function getNearestMunicipalityNorth(array $municipalities): Municipality
    {
        $nearestMunicipality = null;

        foreach ($municipalities as $municipality) {
            if (null === $nearestMunicipality || $municipality->getLatitude() < $nearestMunicipality->getLatitude()) {
                $nearestMunicipality = $municipality;
            }
        }

        return $nearestMunicipality;
    }

    /**
     * @param Municipality[]
     * @return Municipality
     */
    private function getNearestMunicipalitySouth(array $municipalities): Municipality
    {
        $nearestMunicipality = null;

        foreach ($municipalities as $municipality) {
            if (null === $nearestMunicipality || $municipality->getLatitude() > $nearestMunicipality->getLatitude()) {
                $nearestMunicipality = $municipality;
            }
        }

        return $nearestMunicipality;
    }

    /**
     * @param Municipality[]
     * @return Municipality
     */
    private function getNearestMunicipalityEast(array $municipalities): Municipality
    {
        $nearestMunicipality = null;

        foreach ($municipalities as $municipality) {
            if (null === $nearestMunicipality || $municipality->getLongitude() > $nearestMunicipality->getLongitude()) {
                $nearestMunicipality = $municipality;
            }
        }

        return $nearestMunicipality;
    }

    /**
     * @param Municipality[]
     * @return Municipality
     */
    private function getNearestMunicipalityWest(array $municipalities): Municipality
    {
        $nearestMunicipality = null;

        foreach ($municipalities as $municipality) {
            if (null === $nearestMunicipality || $municipality->getLongitude() < $nearestMunicipality->getLongitude()) {
                $nearestMunicipality = $municipality;
            }
        }

        return $nearestMunicipality;
    }
}