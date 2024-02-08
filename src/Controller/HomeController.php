<?php

namespace App\Controller;

use App\Repository\ListeRepository;
use App\Repository\SerieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(SerieRepository $lr): Response
    {
        return $this->render('home/index.html.twig', [
            'listes' => $lr->findALlMine(),
        ]);

    }
}
