<?php
declare(strict_types=1);

namespace App\Controller;

use JulienLinard\Core\Controller\Controller;
use JulienLinard\Router\Attributes\Route;
use JulienLinard\Router\Response;

class GamesupController extends Controller
{
    /**
     * Route racine : affiche la page d'accueil
     * 
     * CONCEPT : Route simple sans middleware
     */
    #[Route(path: '/gamesup', methods: ['GET'], name: 'gamesup')]
    public function index(): Response
    {
        return $this->view('gamesup/index', [
            'title' => 'Welcome',
            'message' => 'Hello World!'
        ]);
    }
}