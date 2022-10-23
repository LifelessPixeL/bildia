<?php

namespace App\Controller;

use App\Service\DeleteMunicipalityService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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
        Request $request,
        DeleteMunicipalityService $deleteMunicipalityService
    ): ?JsonResponse
    {
        $deleteMunicipalityService->delete($request->get('municipalityId'));

        return new JsonResponse([
            'success' => true
        ], Response::HTTP_CREATED);
    }
}