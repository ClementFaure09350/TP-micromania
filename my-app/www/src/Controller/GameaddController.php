<?php
declare(strict_types=1);

namespace App\Controller;

use JulienLinard\Core\Controller\Controller;
use JulienLinard\Router\Attributes\Route;
use JulienLinard\Router\Request;
use JulienLinard\Router\Response;
use JulienLinard\Auth\AuthManager;
use JulienLinard\Auth\Middleware\AuthMiddleware;
use JulienLinard\Doctrine\EntityManager;
use JulienLinard\Core\Form\Validator;
use JulienLinard\Core\Session\Session;
use App\Entity\Game;
use App\Entity\Game_type;
use App\Entity\Platform;
use App\Entity\Type;
use App\Service\FileUploadService;

class GameaddController extends Controller
{
    public function __construct(
        private AuthManager $auth,
        private EntityManager $em,
        private Validator $validator,
        private FileUploadService $fileUpload
    ) {}

    #[Route(path: '/gameadd', methods: ['GET'], name: 'gameadd', middleware: [new AuthMiddleware()])]
    public function create(): Response
    {
        return $this->view('gameadd/index', [
            'title' => 'Ajouter un jeu'
        ]);
    }

    #[Route(path: '/gameadd', methods: ['POST'], name: 'gameadd.post', middleware: [new AuthMiddleware()])]
    public function store(Request $request): Response
    {
        // Récupération des champs
        $description = trim((string) $request->getPost('description', ''));
        $priceRaw = $request->getPost('price', '0');
        $stockRaw = $request->getPost('stock', '0');
        $platformRaw = $request->getPost('platform', '');
        $typeRaw = $request->getPost('brandname', '');

        // Normalisation
        $price = is_numeric($priceRaw) ? (int) $priceRaw : 0;
        $stock = is_numeric($stockRaw) ? (int) $stockRaw : 0;
        $type = is_string($typeRaw) ? $typeRaw : '';
        $platform = is_string($platformRaw) ? $platformRaw : '';

        // Validation simple
        $errors = [];

        if (!$this->validator->required($description)) {
            $errors['description'] = 'La description est requise';
        } elseif (mb_strlen($description) > 65535) {
            $errors['description'] = 'Description trop longue';
        }

        if (!$this->validator->required($priceRaw) || !is_numeric($priceRaw) || $price <= 0) {
            $errors['price'] = 'Le prix doit être un nombre supérieur à 0';
        }

        if (!$this->validator->required($stockRaw) || !is_numeric($stockRaw) || $stock < 0) {
            $errors['stock'] = 'Le stock doit être un entier positif';
        }

        if (!$this->validator->required($platformRaw) || !is_string($platformRaw)) {
            $errors['platform'] = 'La platforme doit être un string non vide';
        }

        if (!$this->validator->required($typeRaw) || !is_string($typeRaw)) {
            $errors['type'] = 'Le type doit être un string non vide';
        }

        if (!empty($errors)) {
            Session::flash('error', 'Veuillez corriger les erreurs du formulaire');
            return $this->view('gameadd/index', [
                'title' => 'Ajouter un jeu',
                'errors' => $errors,
                'old' => [
                    'description' => $description,
                    'price' => $priceRaw,
                    'stock' => $stockRaw,
                    'platform' => $platformRaw,
                    'type' => $typeRaw
                ]
            ]);
        }

        // Gérer l'upload d'image (file input name = "image")
        $uploadedFilename = null;
        try {
            if (method_exists($this->fileUpload, 'upload')) {
                $result = $this->fileUpload->upload(['image']);
                if (is_array($result) && !empty($result['filename'])) {
                    $uploadedFilename = $result['filename'];
                } elseif (is_string($result) && $result !== '') {
                    $uploadedFilename = $result;
                }
            } else {
                // fallback sur $_FILES
                $file = $_FILES['image'] ?? null;
                if ($file && isset($file['tmp_name']) && is_uploaded_file($file['tmp_name'])) {
                    $uploadsDir = __DIR__ . '/../../../../public/uploads';
                    if (!is_dir($uploadsDir)) {
                        @mkdir($uploadsDir, 0755, true);
                    }
                    $safeName = preg_replace('/[^a-zA-Z0-9_\.-]/', '_', basename($file['name']));
                    $dest = $uploadsDir . DIRECTORY_SEPARATOR . $safeName;
                    if (@move_uploaded_file($file['tmp_name'], $dest)) {
                        $uploadedFilename = $safeName;
                    }
                }
            }

            // Créer et persister l'entité Game
            $game = new Game();
            // Attribution des propriétés connues par migration
            if (property_exists($game, 'description')) {
                $game->description = $description;
            }
            if (property_exists($game, 'image')) {
                $game->image = $uploadedFilename;
            }
            if (property_exists($game, 'price')) {
                $game->price = $price;
            }
            if (property_exists($game, 'stock')) {
                $game->stock = $stock;
            }
            
            //TODO: faire en sorte que ca marche avec les relations

            $typetab = new Type();
            if (property_exists($typetab, 'type')) {
                $typetab->typename = $type ;
            }

            $platformtab = new Platform();
            if (property_exists($platformtab, 'platform')) {
                $platformtab->platformname = $platform ;
            }

            
            // Si l'entité dispose d'un titre (optionnel), tente de récupérer le champ title
            $title = trim((string) $request->getPost('title', ''));
            if ($title !== '' && property_exists($game, 'title')) {
                $game->title = $title;
            }

            $this->em->persist($game);
            $this->em->flush();

            Session::flash('success', 'Jeu ajouté avec succès');
            return $this->redirect('/gameadd');
        } catch (\Throwable $e) {
            Session::flash('error', 'Erreur lors de l\'ajout : ' . $e->getMessage());
            return $this->view('gameadd/index', [
                'title' => 'Ajouter un jeu',
                'errors' => ['general' => $e->getMessage()],
                'old' => [
                    'description' => $description,
                    'price' => $priceRaw,
                    'stock' => $stockRaw,
                    'platform' => $platformRaw,
                    'type' => $typeRaw
                ]
            ]);
        }
    }
}