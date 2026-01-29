<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ArticleRepository $articleRepository): Response
    {
        // Récupère les 3 articles les plus récents pour le slider
        $sliderArticles = $articleRepository->findLatestForSlider(3);

        // Récupère les 6 articles suivants pour les blocs
        $latestArticles = $articleRepository->findLatestArticles(6, 3);

        return $this->render('home/index.html.twig', [
            'sliderArticles' => $sliderArticles,
            'latestArticles' => $latestArticles,
        ]);
    }
}
