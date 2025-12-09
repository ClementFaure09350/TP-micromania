<?php

/**
 * ============================================
 * TODO REPOSITORY
 * ============================================
 * 
 * Repository personnalisé pour l'entité Todo
 * Ajoute des méthodes spécifiques pour la recherche de todos
 */

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Game;
use JulienLinard\Doctrine\Repository\EntityRepository;

class GameRepository extends EntityRepository
{
    /**
     * Retourne le nom de colonne pour une propriété
     * 
     * @param string $propertyName Nom de la propriété PHP
     * @return string Nom de la colonne en base de données
     */
    private function getColumnName(string $propertyName): string
    {
        $metadata = $this->metadataReader->getMetadata($this->entityClass);
        
        // Vérifier si c'est une colonne
        if (isset($metadata['columns'][$propertyName])) {
            return $metadata['columns'][$propertyName]['name'] ?? $propertyName;
        }
        
        // Vérifier si c'est une relation ManyToOne (utiliser joinColumn)
        if (isset($metadata['relations'][$propertyName]) && $metadata['relations'][$propertyName]['type'] === 'ManyToOne') {
            return $metadata['relations'][$propertyName]['joinColumn'] ?? $propertyName . '_id';
        }
        
        // Par défaut, retourner le nom de la propriété
        return $propertyName;
    }
    
    /**
     * Mappe un tableau de critères (propriétés PHP) vers les noms de colonnes
     * 
     * @param array $criteria Critères avec noms de propriétés PHP
     * @return array Critères avec noms de colonnes SQL
     */
    private function mapCriteriaToColumns(array $criteria): array
    {
        $mapped = [];
        foreach ($criteria as $property => $value) {
            $mapped[$this->getColumnName($property)] = $value;
        }
        return $mapped;
    }
    
    /**
     * Mappe un tableau d'ordre (propriétés PHP) vers les noms de colonnes
     * 
     * @param array $orderBy Ordre avec noms de propriétés PHP
     * @return array Ordre avec noms de colonnes SQL
     */
    private function mapOrderByToColumns(array $orderBy): array
    {
        $mapped = [];
        foreach ($orderBy as $property => $direction) {
            $mapped[$this->getColumnName($property)] = $direction;
        }
        return $mapped;
    }
    
    /**
     * Trouve tous les todos d'un utilisateur
     * 
     * @param int $userId ID de l'utilisateur
     * @return array Liste des todos
     */
    public function findByUser(int $userId): array
    {
        // Utiliser directement le nom de colonne 'user_id' car findBy() utilise les noms de colonnes
        return $this->findBy(['user_id' => $userId], ['created_at' => 'DESC']);
    }
    
    /**
     * Trouve tous les todos complétés d'un utilisateur
     * 
     * @param int $userId ID de l'utilisateur
     * @return array Liste des todos complétés
     */
    public function findCompletedByUser(int $userId): array
    {
        return $this->findBy(
            ['user_id' => $userId, 'completed' => true],
            ['updated_at' => 'DESC']
        );
    }
    
    /**
     * Trouve tous les todos non complétés d'un utilisateur
     * 
     * @param int $userId ID de l'utilisateur
     * @return array Liste des todos non complétés
     */
    public function findPendingByUser(int $userId): array
    {
        return $this->findBy(
            ['user_id' => $userId, 'completed' => false],
            ['created_at' => 'DESC']
        );
    }
    
    /**
     * Trouve un todo par son ID et l'ID de l'utilisateur (sécurité)
     * 
     * @param int $id ID du todo
     * @param int $userId ID de l'utilisateur
     * @return Todo|null Todo trouvé ou null
     */
    public function findByIdAndUser(int $id, int $userId): ?Game
    {
        return $this->findOneBy(['id' => $id, 'user_id' => $userId]);
    }
    
    /**
     * Compte le nombre de todos d'un utilisateur
     * 
     * @param int $userId ID de l'utilisateur
     * @return int Nombre de todos
     */
    public function countByUser(int $userId): int
    {
        return count($this->findByUser($userId));
    }
    
    /**
     * Compte le nombre de todos complétés d'un utilisateur
     * 
     * @param int $userId ID de l'utilisateur
     * @return int Nombre de todos complétés
     */
    public function countCompletedByUser(int $userId): int
    {
        return count($this->findCompletedByUser($userId));
    }
    
    /**
     * Compte le nombre de todos non complétés d'un utilisateur
     * 
     * @param int $userId ID de l'utilisateur
     * @return int Nombre de todos non complétés
     */
    public function countPendingByUser(int $userId): int
    {
        return count($this->findPendingByUser($userId));
    }
    
    /**
     * Charge les relations ManyToMany pour un todo
     * 
     * @param Todo $todo Todo pour lequel charger les médias
     * @return void
     */
    public function loadMediaRelations(Game $todo): void
    {
        if ($todo->id === null) {
            return;
        }
        
        // Charger les médias depuis la table de jointure
        $joinTable = 'todo_media';
        $sql = "SELECT media_id FROM `{$joinTable}` WHERE todo_id = :todo_id";
        $rows = $this->connection->fetchAll($sql, ['todo_id' => $todo->id]);
        
        if (empty($rows)) {
            $todo->media = [];
            return;
        }
        
        // Récupérer les IDs des médias
        $mediaIds = array_column($rows, 'media_id');
        
        // Charger les médias
        $mediaRepository = new \App\Repository\MediaRepository(
            $this->connection,
            $this->metadataReader,
            \App\Entity\Media::class,
            $this->queryCache
        );
        
        $mediaArray = [];
        foreach ($mediaIds as $mediaId) {
            $media = $mediaRepository->find($mediaId);
            if ($media !== null) {
                $mediaArray[] = $media;
            }
        }
        
        $todo->media = $mediaArray;
    }
}