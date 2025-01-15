<?php

namespace Unity\Animals;

use InvalidArgumentException;

class AnimalFactory
{
    public function createAnimal(string $name, string $species, callable $eatingBehavior, bool $isFurry): Animal
    {
        if (!is_callable($eatingBehavior)) {
            throw new InvalidArgumentException("The eating behavior must be a callable");
        }
        return match ($isFurry) {
            true => new AnimalWithFur($name, $species, $eatingBehavior),
            false => new AnimalWithoutFur($name, $species, $eatingBehavior),
        };
    }
}
