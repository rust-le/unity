<?php
namespace Unity\Zoo;

use Unity\Animals\Animal;

class Zoo
{
    private array $animals = [];

    public function addAnimal(Animal $animal): void
    {
        $this->animals[] = $animal;
    }

    public function listAnimals(): array
    {
        return $this->animals;
    }
}
