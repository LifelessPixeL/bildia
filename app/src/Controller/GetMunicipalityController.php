<?php

namespace App\Controller;

use App\Interface\GetMunicipalitiesInterface;
use App\Interface\MunicipalityRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_')]
class GetMunicipalityController extends AbstractController
{
    public function __construct(private GetMunicipalitiesInterface $getMunicipalitiesService) {}

    #[Route(
        '/municipality/{municipalityId}',
        name: 'getMunicipality',
        requirements: ['municipalityId' => '\d+'],
        methods: ['GET']
    )]
    public function getMunicipality(
        int $municipalityId,
        MunicipalityRepositoryInterface $municipalityRepository
    ): ?JsonResponse
    {

        $municipality = $this->getMunicipalitiesService->getMunicipality($municipalityId);

        return new JsonResponse([
            'success' => true,
            'data' => [
                'id' => $municipality->getId(),
                'name' => $municipality->getName(),
                'latitude' => $municipality->getLatitude(),
                'longitude' => $municipality->getLongitude(),
            ],
        ], Response::HTTP_OK);
    }

    #[Route(
        '/municipalities',
        name: 'getMunicipalities',
        methods: ['GET']
    )]
    public function getMunicipalities(): ?JsonResponse
    {
        return new JsonResponse([
            'success' => true,
            'data' => $this->getMunicipalitiesService->getMunicipalities(),
        ], Response::HTTP_OK);
    }
}