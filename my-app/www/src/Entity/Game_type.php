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

#[Entity(table: "game_type")]
class Game_type{

    use Authenticatable;

    #[Id]
    #[Column(type:"integer", autoIncrement: true)]
    public ?int $id = null;

    #[ManyToOne(targetEntity: Game::class, inversedBy: 'game_type')]
    public int $game_id;

    #[ManyToOne(targetEntity: Type::class, inversedBy: 'typename')]
    public int $type_id;


};