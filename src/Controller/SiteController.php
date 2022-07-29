<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\RandGenerator;


class SiteController extends AbstractController
{
    #[Route('/', name: 'app_site_home')]
    public function home(RandGenerator $randomGenerator): Response
    {
        $rand = $randomGenerator->randomNumber(1, 99);

        return $this->render('site/home.html.twig', [
            'controllerName' => 'SiteController',
            'randomNumber' => $rand,
        ]);
    }

    #[Route('/site', name: 'app_site')]
    public function index(): Response
    {
        return $this->render('site/index.html.twig', [
            'controller_name' => 'SiteController',
        ]);
    }

    #[Route('/random-number', name: 'app_site_random_number')]
    public function randomNumber(RandGenerator $randomGenerator): Response
    {
        $rand = $randomGenerator->randomNumber(1, 6);

        return new Response($rand);
    }
}
