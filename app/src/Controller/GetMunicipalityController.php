<?php

namespace App\Controller;

use App\Interface\MunicipalityRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
        MunicipalityRepositoryInterface $municipalityRepository
    ): ?JsonResponse
    {
        $serializerMunicipalities = [];
        foreach ($municipalityRepository->findAll() as $municipality) {
            $serializerMunicipalities[] = (array) $municipality;
        }

        return new JsonResponse($serializerMunicipalities);
    }
}