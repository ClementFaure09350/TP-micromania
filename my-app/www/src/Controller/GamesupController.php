<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Game;
use JulienLinard\Core\Controller\Controller;
use JulienLinard\Doctrine\EntityManager;
use JulienLinard\Router\Attributes\Route;
use JulienLinard\Router\Response;
use JulienLinard\Router\Request;
use JulienLinard\Core\Session\Session;

class GamesupController extends Controller
{

    public function __construct(
        private EntityManager $em,
    ) {}

    /**
     * Route racine : affiche la page d'accueil
     * 
     * CONCEPT : Route simple sans middleware
     */
    #[Route(path: '/gamesup', methods: ['GET'], name: 'gamesup')]
    public function index(): Response
    {
        // Récupère le repository via l'EntityManager
        $gameRepo = $this->em->getRepository(Game::class);
        $game = $gameRepo->findAll();

        return $this->view('gamesup/index', [
            'title' => 'Welcome',
            'message' => 'Hello World!',
            'game' => $game
        ]);
    }

    /**
     * Supprime un jeu
     */
    #[Route(path: '/gamesup/delete', methods: ['POST'], name: 'gamesup.delete')]
    public function delete(Request $request): Response
    {
        $id = (int) $request->getBodyParam('game_id', 0);
        if ($id <= 0) {
            Session::flash('error', 'ID invalide');
            return $this->redirect('/gamesup');
        }

        $game = $this->em->find(Game::class, $id);
        if (!$game) {
            Session::flash('error', 'Jeu introuvable');
            return $this->redirect('/gamesup');
        }

        try {
            $this->em->remove($game);
            $this->em->flush();
            Session::flash('success', 'Jeu supprimé avec succès');
        } catch (\Throwable $e) {
            Session::flash('error', 'Erreur lors de la suppression : ' . $e->getMessage());
        }

        return $this->redirect('/gamesup');
    }
}