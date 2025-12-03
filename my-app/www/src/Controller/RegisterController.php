<?php
namespace App\Controller;

use JulienLinard\Core\Controller\Controller;
use JulienLinard\Router\Attributes\Route;
use JulienLinard\Router\Response;

class RegisterController extends Controller
{
    /**
     * Route racine : affiche la page d'accueil
     * 
     * CONCEPT : Route simple sans middleware
     */
    #[Route(path: '/register', methods: ['GET'], name: 'register')]
    public function index(): Response
    {
        return $this->view('register/index', [
            'title' => 'Welcome',
            'message' => 'tu es dans le register'
        ]);
    }
}