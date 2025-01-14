<?php

namespace Unity\Animals;

class EatingBehaviors
{
    private static function eat(string $name, string $foodType, array $acceptableFoods): void
    {
        if (in_array($foodType, $acceptableFoods, true)) {
            echo $name . " eats the " . $foodType . ".\n";
        } else {
            echo $name . " refuses to eat " . $foodType . ".\n";
        }
    }

    public static function carnivorous(string $name, string $foodType): void
    {
        self::eat($name, $foodType, ["meat"]);
    }

    public static function herbivorous(string $name, string $foodType): void
    {
        self::eat($name, $foodType, ["plant"]);
    }

    public static function omnivorous(string $name, string $foodType): void
    {
        self::eat($name, $foodType, ["meat", "plant"]);
    }
}
