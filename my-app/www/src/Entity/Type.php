<?php

namespace App\Entity;


use DateTime;
use JulienLinard\Auth\Models\Authenticatable;
use JulienLinard\Doctrine\Mapping\Id;
use JulienLinard\Doctrine\Mapping\Column;
use JulienLinard\Doctrine\Mapping\Entity;
use JulienLinard\Auth\Models\UserInterface;
use JulienLinard\Doctrine\Mapping\OneToMany;

#[Entity(table: "type")]
class Type{

    use Authenticatable;

    #[Id]
    #[Column(type:"integer", autoIncrement: true)]
    public ?int $id = null;

    #[Column(type:"string", length:255)]
    public string $typename;

    #[OneToMany(targetEntity: Game_type::class, mappedBy: 'game', cascade: ['persist', 'remove'])]
    public array $game = [];

};