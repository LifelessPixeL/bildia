<?php

namespace App\Controller;

use App\Interface\DeleteMunicipalityInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

#[Route('/api', name: 'api_')]
class DeleteMunicipalityController extends AbstractController
{
    #[Route(
        '/municipality/{municipalityId}',
        name: 'deleteMunicipality',
        requirements: ['municipalityId' => '\d+'],
        methods: ['DELETE']
    )]
    public function deleteMunicipality(
        int $municipalityId,
        DeleteMunicipalityInterface $deleteMunicipalityService
    ): ?JsonResponse
    {
        $deleteMunicipalityService->delete($municipalityId);

        return new JsonResponse([
            'success' => true
        ], Response::HTTP_OK);
    }
}