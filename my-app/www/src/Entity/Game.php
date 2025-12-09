<?php

namespace App\Entity;


use DateTime;
use JulienLinard\Auth\Models\Authenticatable;
use JulienLinard\Doctrine\Mapping\Id;
use JulienLinard\Doctrine\Mapping\Column;
use JulienLinard\Doctrine\Mapping\Entity;
use JulienLinard\Auth\Models\UserInterface;
use JulienLinard\Doctrine\Mapping\OneToMany;

#[Entity(table: "game")]
class Game{

    use Authenticatable;

    #[Id]
    #[Column(type:"integer", autoIncrement: true)]
    public ?int $id = null;

    #[Column(type:"text")]
    public string $description;

    #[Column(type:"string", nullable:true, length:255)]
    public ?string $image = null;

    #[Column(type:"int")]
    public int $price;

    #[Column(type:"int")]
    public int $stock;

    #[Column(type:"string", nullable:true, length:255)]
    public string $title;

    #[OneToMany(targetEntity: Basket::class, mappedBy: 'game', cascade: ['persist', 'remove'])]
    public array $basket = [];

    #[OneToMany(targetEntity: Game_type::class, mappedBy: 'game', cascade: ['persist', 'remove'])]
    public array $type = [];

    #[OneToMany(targetEntity: Game_platform::class, mappedBy: 'game', cascade: ['persist', 'remove'])]
    public array $platform = [];

}