<?php
namespace App\Controller;

use JulienLinard\Core\Controller\Controller;
use JulienLinard\Router\Attributes\Route;
use JulienLinard\Router\Response;

class LoginController extends Controller
{
    /**
     * Route racine : affiche la page d'accueil
     * 
     * CONCEPT : Route simple sans middleware
     */
    #[Route(path: '/login', methods: ['GET'], name: 'login')]
    public function index(): Response
    {
        return $this->view('login/index', [
            'title' => 'Welcome',
            'message' => 'tu es dans le login'
        ]);
    }
}