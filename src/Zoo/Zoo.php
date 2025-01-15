<?php

namespace Unity\Zoo;

use Unity\Animals\Animal;

final class Zoo
{
    private static ?self $instance = null;
    private array $animals = [];

    private function __construct()
    {
    }

    public static function create(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function addAnimal(Animal $animal): void
    {
        $this->animals[] = $animal;
    }

    public function listAnimals(): array
    {
        return $this->animals;
    }

    private function __clone()
    {
    }
}
