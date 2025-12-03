<?php
namespace App\Controller;

use JulienLinard\Core\Controller\Controller;
use JulienLinard\Router\Attributes\Route;
use JulienLinard\Router\Response;

class AdminpageController extends Controller
{
    /**
     * Route racine : affiche la page d'accueil
     * 
     * CONCEPT : Route simple sans middleware
     */
    #[Route(path: '/adminpage', methods: ['GET'], name: 'adminpage')]
    public function index(): Response
    {
        return $this->view('adminpage/index', [
            'title' => 'Welcome',
            'message' => 'tu es dans le login'
        ]);
    }
}