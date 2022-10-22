<?php

namespace App\Controller;

use App\Interface\NearestMunicipalityInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_')]
class NearestMunicipalityController extends AbstractController
{
    #[Route('/municipality/{cardinal}', name: 'nearestMunicipalityToCardinal', requirements: ['cardinal' => 'n|s|e|w'], methods: ['GET', 'HEAD'])]
    public function getNearestMunicipalityToCardinal(Request $request, NearestMunicipalityInterface $nearestMunicipality): JsonResponse
    {
        $municipalitiesIds = json_decode($request->get('municipalities'));
        $cardinal = $request->get('cardinal');

        $nearestMunicipality = $nearestMunicipality->getNearestMunicipality($municipalitiesIds, $cardinal);

        return new JsonResponse(['municipality' => $nearestMunicipality]);
    }
}
