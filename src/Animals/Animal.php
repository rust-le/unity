<?php
namespace Unity\Animals;

interface Animal
{
    public function getName(): string;

    public function getSpecies(): string;

    public function eat(string $foodType): void;
}
