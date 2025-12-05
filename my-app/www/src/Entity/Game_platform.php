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

#[Entity(table: "game_platform")]
class Game_platform{

    use Authenticatable;

    #[Id]
    #[Column(type:"integer", autoIncrement: true)]
    public ?int $id = null;

    #[ManyToOne(targetEntity: Game::class, inversedBy: 'game_type')]
    public int $game_id;

    #[ManyToOne(targetEntity: Platform::class, inversedBy: 'typename')]
    public int $platform_id;


};