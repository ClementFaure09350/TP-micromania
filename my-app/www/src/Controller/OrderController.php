<?php
namespace App\Controller;

use JulienLinard\Core\Controller\Controller;
use JulienLinard\Router\Attributes\Route;
use JulienLinard\Router\Response;

class OrderController extends Controller
{
    /**
     * Route racine : affiche la page d'accueil
     * 
     * CONCEPT : Route simple sans middleware
     */
    #[Route(path: '/order', methods: ['GET'], name: 'order')]
    public function index(): Response
    {
        return $this->view('order/index', [
            'title' => 'Welcome',
            'message' => 'tu es dans le l order'
        ]);
    }
}