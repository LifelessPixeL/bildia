<?php

namespace App\Controller;

use App\Interface\NearestMunicipalityInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_')]
class NearestMunicipalityController extends AbstractController
{
    #[Route('/municipality/{cardinal}/{municipalities}',
        name: 'nearestMunicipalityToCardinal',
        requirements: ['cardinal' => 'n|s|e|w', 'municipalities' => '^[0-9]+(,[0-9]+)*$'],
        methods: ['GET']
    )]
    public function getNearestMunicipalityToCardinal(Request $request, NearestMunicipalityInterface $nearestMunicipality): JsonResponse
    {
        $municipalitiesIds = explode(',', $request->get('municipalities'));
        $cardinal = $request->get('cardinal');

        $nearestMunicipality = $nearestMunicipality->getNearestMunicipality($municipalitiesIds, $cardinal);

        return new JsonResponse([
            'success' => true,
            'nearestMunicipality' => $nearestMunicipality->getName(),
        ], Response::HTTP_OK);
    }
}
