<?php

namespace App\Entity;


use DateTime;
use JulienLinard\Auth\Models\Authenticatable;
use JulienLinard\Doctrine\Mapping\Id;
use JulienLinard\Doctrine\Mapping\Column;
use JulienLinard\Doctrine\Mapping\Entity;
use JulienLinard\Auth\Models\UserInterface;
use JulienLinard\Doctrine\Mapping\ManyToOne;
use JulienLinard\Doctrine\Mapping\OneToMany;

#[Entity(table: "basket")]
class Basket{

    use Authenticatable;

    #[Id]
    #[Column(type:"integer", autoIncrement: true)]
    public ?int $id = null;

    #[ManyToOne(targetEntity: User::class, inversedBy: 'basket')]
    public int $user_id;

    #[ManyToOne(targetEntity: Game::class, inversedBy: 'basket')]
    public int $game_id;

    #[Column(type:"datetime", nullable: true)]
    public ?DateTime $created_at;

    #[Column(type:"string", length:255)]
    public string $statut;

};