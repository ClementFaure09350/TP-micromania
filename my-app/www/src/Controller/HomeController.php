<?php

/**
 * ============================================
 * HOME CONTROLLER
 * ============================================
 * 
 * CONCEPT PÉDAGOGIQUE : Controller simple
 * 
 * Ce contrôleur gère la route racine "/" et affiche la page d'accueil.
 */

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Game;
use App\Repository\GameRepository;
use JulienLinard\Core\Controller\Controller;
use JulienLinard\Doctrine\EntityManager;
use JulienLinard\Router\Attributes\Route;
use JulienLinard\Router\Response;

class HomeController extends Controller
{
    public function __construct(
        private EntityManager $em,
    ) {}
    /**
     * Route racine : affiche la page d'accueil
     * 
     * CONCEPT : Route simple sans middleware
     */
    #[Route(path: '/', methods: ['GET'], name: 'home')]
    public function index(): Response
    {
        // Récupère le repository via l'EntityManager
        $gameRepo = $this->em->getRepository(Game::class);
        $game = $gameRepo->findAll();

        return $this->view('home/index', [
            'title' => 'Welcome',
            'message' => 'Hello World!',
            'game' => $game
        ]);
    }
}
