<?php

namespace App\Controller;

use App\Service\UpdateProvinceService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Annotations as OA;

class UpdateProvincePopulationController extends AbstractController
{
    /**
     * Update province population
     *
     * @Route("/api/province/{provinceId}", methods={"PUT"})
     * @OA\Response(
     *     response=200,
     *     description="Success or Error",
     * )
     * @OA\Parameter(
     *     name="provinceId",
     *     in="path",
     *     required=true,
     *     description="The province ID",
     *     @OA\Schema(type="number")
     * )
     * @OA\Parameter(
     *     name="population",
     *     in="query",
     *     required=true,
     *     description="The new population amount",
     *     @OA\Schema(type="number")
     * )
     */
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