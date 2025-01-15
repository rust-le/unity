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

        $eatingBehavior = \Closure::fromCallable($eatingBehavior);

        return match ($isFurry) {
            true => new class($name, $species, $eatingBehavior) extends AnimalBase {
                use Groomable;
            },
            false => new class($name, $species, $eatingBehavior) extends AnimalBase {
            },
        };
    }
}
