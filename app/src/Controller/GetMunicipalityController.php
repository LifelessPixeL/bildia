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
    #[Route(
        '/municipality/{municipalityId}',
        name: 'getMunicipality',
        requirements: ['municipalityId' => '\d+'],
        methods: ['GET', 'HEAD']
    )]
    public function getMunicipality(
        int $municipalityId,
        MunicipalityRepositoryInterface $municipalityRepository
    ): ?JsonResponse
    {
        return new JsonResponse(['municipality' => (array) $municipalityRepository->find($municipalityId)]);
    }

    #[Route(
        '/municipalities',
        name: 'getMunicipalities',
        methods: ['GET', 'HEAD']
    )]
    public function getMunicipalities(
        GetMunicipalitiesInterface $getMunicipalitiesService,
    ): ?JsonResponse
    {
        return new JsonResponse([
            'success' => true,
            'data' => $getMunicipalitiesService->getMunicipalities(),
        ], Response::HTTP_OK);
    }
}