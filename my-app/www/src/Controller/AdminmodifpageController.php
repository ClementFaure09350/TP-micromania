<?php
namespace App\Controller;

use JulienLinard\Core\Controller\Controller;
use JulienLinard\Router\Attributes\Route;
use JulienLinard\Router\Response;

class AdminmodifpageController extends Controller
{
    /**
     * Route racine : affiche la page d'accueil
     * 
     * CONCEPT : Route simple sans middleware
     */
    #[Route(path: '/adminmodif', methods: ['GET'], name: 'adminmodif')]
    public function index(): Response
    {
        return $this->view('adminmodif/index', [
            'title' => 'Welcome',
            'message' => 'tu es dans le login'
        ]);
    }
}