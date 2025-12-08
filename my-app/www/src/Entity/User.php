<?php

namespace App\Entity;


use DateTime;
use JulienLinard\Auth\Models\Authenticatable;
use JulienLinard\Doctrine\Mapping\Id;
use JulienLinard\Doctrine\Mapping\Column;
use JulienLinard\Doctrine\Mapping\Entity;
use JulienLinard\Auth\Models\UserInterface;
use JulienLinard\Doctrine\Mapping\OneToMany;
use JulienLinard\Doctrine\Mapping\Index;

#[Entity(table: "user")]
class User implements UserInterface{

    use Authenticatable;

    #[Id]
    #[Column(type:"integer", autoIncrement: true)]
    public ?int $id = null;

    #[Column(type:"string", length: 150)]
    public string $email;

    #[Column(type:"string", length: 255)]
    public string $password;

    #[Column(type:"string", length: 100)]
    public string $firstname;

    #[Column(type:"string", length: 100)]
    public string $lastname;

    #[Column(type:"datetime", nullable: true)]
    public ?DateTime $created_at;


    #[Column(type:"string", default: 'user')]
    public string $role;

    #[OneToMany(targetEntity: Basket::class, mappedBy: 'user', cascade: ['persist', 'remove'])]
    public array $basket = [];



    /**
     * Retourne les rôles de l'utilisateur
     * 
     * @return array|string
     */
    public function getAuthRoles(): array|string
    {
        return $this->role ?? 'user';
    }
    
    /**
     * Retourne les permissions de l'utilisateur
     * 
     * @return array
     */
    public function getAuthPermissions(): array
    {
        // Permissions basées sur le rôle
        return match($this->role) {
            'admin' => ['manage-users', 'edit-posts', 'delete-posts'],
            'moderator' => ['edit-posts', 'delete-posts'],
            'user' => ['view-posts'],
            default => []
        };
    }
}