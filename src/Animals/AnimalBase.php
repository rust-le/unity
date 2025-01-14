<?php

namespace Unity\Animals;

use Unity\Animals;

class AnimalBase implements Animal
{
    private readonly string $name;
    private readonly string $species;
    private $eatingBehavior;

    public function __construct(string $name, string $species, callable $eatingBehavior)
    {
        $this->name = $name;
        $this->species = $species;
        $this->eatingBehavior = $eatingBehavior;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSpecies(): string
    {
        return $this->species;
    }

    public function eat(string $foodType): void
    {
        call_user_func($this->eatingBehavior, $this->name, $foodType);
    }

    public function __toString(): string
    {
        return $this->species . " " . $this->name;
    }
}
