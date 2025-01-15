<?php

namespace Unity\Animals;

use PHPUnit\Framework\TestCase;

class AnimalBaseTest extends TestCase
{
    private Animal $animal;

    public function testGetName()
    {
        $this->assertEquals('Leo', $this->animal->getName());
    }

    public function testGetSpecies()
    {
        $this->assertEquals('Lion', $this->animal->getSpecies());
    }

    public function testToString()
    {
        $this->assertEquals('Lion Leo', (string)$this->animal);
    }

    protected function setUp(): void
    {
        $this->animal = new AnimalBase('Leo', 'Lion', function ($name, $foodType) {
        });
    }
}
