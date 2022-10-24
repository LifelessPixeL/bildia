<?php

namespace App\Controller;

use App\Interface\ProvincesPopulationPercentageInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_')]
class GetProvincesPopulationPercentageController extends AbstractController
{
    #[Route(
        '/provinces/percentage/{provincesIds}',
        name: 'getProvincesPopulationPercentage',
        methods: ['GET']
    )]
    public function getProvincesPopulationPercentage(
        Request $request,
        ProvincesPopulationPercentageInterface $provincesPopulationPercentageService
    ): ?JsonResponse
    {
        $provincesIds = explode(',', $request->get('provincesIds'));

        $provincesPopulationPercentageFromTotal =
            $provincesPopulationPercentageService->getProvincesPopulationPercentage($provincesIds);

        return new JsonResponse([
            'success' => true,
            'provincesPopulationPercentage' => $provincesPopulationPercentageFromTotal
        ], Response::HTTP_OK);
    }
}