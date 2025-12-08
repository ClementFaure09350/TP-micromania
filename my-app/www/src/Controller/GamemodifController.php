<?php
declare(strict_types=1);

namespace App\Controller;

use JulienLinard\Core\Controller\Controller;
use JulienLinard\Router\Attributes\Route;
use JulienLinard\Router\Response;

class GamemodifController extends Controller
{
    /**
     * Route racine : affiche la page d'accueil
     * 
     * CONCEPT : Route simple sans middleware
     */
    #[Route(path: 'gamemodif', methods: ['GET'], name: 'gamemodif')]
    public function index(): Response
    {
        return $this->view('gamemodif/index', [
            'title' => 'Welcome',
            'message' => 'Hello World!'
        ]);
    }
}