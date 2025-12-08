<?php
namespace App\Controller;

use App\Entity\Game;
use JulienLinard\Core\Controller\Controller;
use JulienLinard\Router\Attributes\Route;
use JulienLinard\Router\Request;
use JulienLinard\Router\Response;
use JulienLinard\Auth\AuthManager;
use JulienLinard\Auth\Middleware\AuthMiddleware;
use JulienLinard\Doctrine\EntityManager;
use JulienLinard\Core\Session\Session;
use App\Entity\Media;
use App\Repository\GameRepository;
use App\Repository\MediaRepository;
use App\Service\FileUploadService;

class GameaddController extends Controller
{
    public function __construct(
        private AuthManager $auth,
        private EntityManager $em,
        private FileUploadService $fileUpload
    ){}
    /**
     * Route racine : affiche la page d'accueil
     * 
     * CONCEPT : Route simple sans middleware
     */
    #[Route(path: '/gameadd', methods: ['GET'], name: 'gameadd')]
    public function index(): Response
    {
        return $this->view('gameadd/index', [
            'title' => 'Welcome',
            'message' => 'Hello World!'
        ]);
    }

    #[Route(path: '/gameadd', methods: ['POST'], name: 'gameaddPost')]
    public function store(Request $request): Response
    {
        $user = $this->auth->user();
        if (!$user) {
            return $this->redirect('/login');
        }
        
        // Pour les formulaires multipart/form-data, utiliser getPost() au lieu de getBodyParam()
        $title = trim($request->getPost('title', '') ?? '');
        $description = trim($request->getPost('description', '') ?? '');
        $price = $request->getPost('price') ?? 0;
        $stock = $request->getPost('stock') ?? 0;
        $type = $request->getPost('type') ?? [];
        $platform = $request->getPost('platform') ?? [];
        
        // Validation
        $errors = [];
        
        if (empty($title)) {
            $errors['title'] = 'Le titre est requis';
        } elseif (strlen($title) > 255) {
            $errors['title'] = 'Le titre ne doit pas dépasser 255 caractères';
        }
        
        if (!empty($errors)) {
            Session::flash('error', 'Veuillez corriger les erreurs du formulaire');
            return $this->view('todos/create', [
                'title' => 'Créer un Todo',
                'errors' => $errors,
                'old' => [
                    'title' => $title ?? '',
                    'description' => $description ?? ''
                ]
            ]);
        }
        
        try {
            // Créer le Game
            $game = new Game();
            $game->title = $title;
            $game->description = $description ?: null;
            $game->image = $request->getPost('image', '') ?: null;
            $game->price = $price;
            $game->stock = $stock;
            $game->type = $type;
            $game->platform = $platform;
            
            
            $this->em->persist($game);
            $this->em->flush();
            
            // Gérer l'upload de médias (optionnel)
            $uploadResult = $this->handleMediaUpload($request);
            $uploadErrors = [];
            
            
            if ($uploadResult->hasUploaded()) {
                $game->image = '';
                $uploadedFiles = $uploadResult->getUploaded();
                
                foreach ($uploadedFiles as $mediaData) {
                    try {
                        $media = new Media();
                        $media->filename = $mediaData['filename'];
                        $media->original_filename = $mediaData['original_filename'];
                        $media->path = $mediaData['path'];
                        $media->size = $mediaData['size'];
                        $media->mime_type = $mediaData['mime_type'];
                        $media->type = $mediaData['type'];
                        $media->created_at = new \DateTime();
                        $media->updated_at = new \DateTime();
                        
                        $this->em->persist($media);
                        $this->em->flush();
                        
                        $game->image[] = $media;
                    } catch (\Exception $e) {
                        $uploadErrors[] = 'Erreur lors de l\'enregistrement de ' . $mediaData['original_filename'] . ': ' . $e->getMessage();
                        // Supprimer le fichier uploadé si l'enregistrement échoue
                        $this->fileUpload->delete($mediaData['filename']);
                    }
                }
                
               
            }
            
            // Afficher les erreurs d'upload s'il y en a
            if ($uploadResult->hasErrors()) {
                $uploadErrors[] = $uploadResult->getErrorsAsString();
            }
            
            // Invalider le cache pour forcer le rechargement des données
            $queryCache = $this->em->getQueryCache();
            if ($queryCache !== null) {
                $queryCache->invalidateEntity(Game::class, $game->id);
            }
            
            if (!empty($uploadErrors)) {
                Session::flash('error', 'Todo créé mais certaines erreurs sont survenues lors de l\'upload: ' . implode(', ', $uploadErrors));
            } else {
                Session::flash('success', 'Todo créé avec succès !');
            }
            
            return $this->redirect('/todos');
        } catch (\Exception $e) {
            Session::flash('error', 'Une erreur est survenue lors de la création du todo: ' . $e->getMessage());
            return $this->view('todos/create', [
                'title' => 'Créer un Todo',
                'old' => [
                    'title' => $title ?? '',
                    'description' => $description ?? ''
                ],
                'errors' => ['general' => $e->getMessage()]
            ]);
        }

        
    }
}