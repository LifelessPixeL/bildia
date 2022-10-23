<?php

namespace App\Controller;

use App\Service\UpdateProvinceService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

#[Route('/api', name: 'api_')]
class UpdateProvincePopulationController extends AbstractController
{
    #[Route(
        '/province/{provinceId}',
        name: 'updateProvincePopulation',
        requirements: ['provinceId' => '\d+'],
        methods: ['PUT']
    )]
    public function updateProvincePopulation(
        Request $request,
        UpdateProvinceService $updateProvinceService
    ): ?JsonResponse
    {
        $updateProvinceService->updateProvincePopulation(
            $request->get('provinceId'),
            $request->get('population')
        );

        return new JsonResponse([
            'success' => true
        ], Response::HTTP_OK);
    }
}