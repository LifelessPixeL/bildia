<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\ProvincesPopulationPercentageService;

#[Route('/api', name: 'api_')]
class GetProvincesPopulationPercentage extends AbstractController
{
    #[Route(
        '/provinces/percentage',
        name: 'getProvincesPopulationPercentage',
        methods: ['GET', 'HEAD']
    )]
    public function getProvincesPopulationPercentage(
        Request $request,
        ProvincesPopulationPercentageService $provincesPopulationPercentageService
    ): ?JsonResponse
    {
        $provincesIds = json_decode($request->get('provincesIds'));

        $provincesPopulationPercentageFromTotal =
            $provincesPopulationPercentageService->getProvincesPopulationPercentage($provincesIds);

        return new JsonResponse([
            'success' => true,
            'provincesPopulationPercentage' => $provincesPopulationPercentageFromTotal
        ], Response::HTTP_OK);
    }
}