<?php

namespace App\Service;


use App\Entity\Municipality;
use App\Interface\MunicipalityRepositoryInterface;
use App\Interface\ProvinceRepositoryInterface;
use App\Interface\SaveMunicipalityInterface;
use Exception;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class SaveMunicipalityService implements SaveMunicipalityInterface
{
    public function __construct(
        private ProvinceRepositoryInterface $provinceRepository,
        private MunicipalityRepositoryInterface $municipalityRepository,
        private ValidatorInterface $validator
    ) {}

    /**
     * @throws Exception
     */
    public function saveMunicipality(string $slug, string $name, float $latitude, float $longitude, int $provinceId): void
    {
        $province = $this->provinceRepository->find($provinceId);

        $municipality = new Municipality();
        $municipality->setSlug($slug);
        $municipality->setName($name);
        $municipality->setLatitude($latitude);
        $municipality->setLongitude($longitude);
        $municipality->setProvince($province);

        $errors = $this->validator->validate($municipality);

        if (count($errors) > 0) {
            throw new Exception((string) $errors);
        }

        $this->municipalityRepository->save($municipality);
    }
}