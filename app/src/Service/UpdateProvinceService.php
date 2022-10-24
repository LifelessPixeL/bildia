<?php

namespace App\Service;

use App\Interface\ProvinceRepositoryInterface;
use App\Interface\UpdateProvinceInterface;
use Exception;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UpdateProvinceService implements UpdateProvinceInterface
{
    public function __construct(
        private ProvinceRepositoryInterface $provinceRepository,
        private ValidatorInterface $validator
    ) {}

    /**
     * @throws Exception
     */
    public function updateProvincePopulation(int $provinceId, int $population): void
    {
        $province = $this->provinceRepository->find($provinceId);

        $province->setPopulation($population);

        $errors = $this->validator->validate($province);

        if (count($errors) > 0) {
            throw new Exception((string) $errors);
        }

        $this->provinceRepository->update();
    }
}