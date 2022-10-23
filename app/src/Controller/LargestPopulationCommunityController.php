<?php

namespace App\Controller;

use App\Interface\LargestPopulationCommunityInterface;
use Doctrine\DBAL\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_')]
class LargestPopulationCommunityController extends AbstractController
{
    public function __construct(private LargestPopulationCommunityInterface $largestPopulationCommunity) {}

    /**
     * @throws Exception
     */
    #[Route(
        '/community/{firstCommunity}/{secondCommunity}',
        name: 'largestPopulationCommunity',
        requirements: ['firstCommunity' => '\d+', 'secondCommunity' => '\d+'],
        methods: ['GET', 'HEAD']
    )]
    public function getLargestPopulationCommunity(int $firstCommunity, int $secondCommunity): JsonResponse
    {
        $largestPopulationCommunity = $this->largestPopulationCommunity->getLargestPopulationCommunity($firstCommunity, $secondCommunity);

        return new JsonResponse(['community' => (array) $largestPopulationCommunity]);
    }
}
