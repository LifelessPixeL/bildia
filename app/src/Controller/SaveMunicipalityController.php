<?php

namespace App\Controller;

use App\Interface\SaveMunicipalityInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

#[Route('/api', name: 'api_')]
class SaveMunicipalityController extends AbstractController
{
    #[Route(
        '/municipality',
        name: 'saveMunicipality',
        methods: ['POST']
    )]
    public function saveMunicipality(
        Request $request,
        SaveMunicipalityInterface $saveMunicipality
    ): ?JsonResponse
    {
        $slug = $request->get('slug');
        $name = $request->get('name');
        $latitude = $request->get('latitude');
        $longitude = $request->get('longitude');

        $saveMunicipality->saveMunicipality($slug, $name, $latitude, $longitude);

        return new JsonResponse([
            'success' => true
        ], Response::HTTP_CREATED);
    }
}