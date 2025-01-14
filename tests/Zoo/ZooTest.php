<?php

namespace Unity\Zoo;

use PHPUnit\Framework\TestCase;
use Unity\Animals\Animal;

class ZooTest extends TestCase
{
    private Zoo $zoo;
    private Animal $animalMock;

    protected function setUp(): void
    {
        $this->zoo = new Zoo();
        $this->animalMock = $this->createMock(Animal::class);
    }

    public function testAddAnimal()
    {
        $this->zoo->addAnimal($this->animalMock);
        $this->assertCount(1, $this->zoo->listAnimals());
        $this->assertSame($this->animalMock, $this->zoo->listAnimals()[0]);
    }

    public function testListAnimals()
    {
        $this->assertIsArray($this->zoo->listAnimals());
        $this->assertCount(0, $this->zoo->listAnimals());

        $this->zoo->addAnimal($this->animalMock);
        $this->assertCount(1, $this->zoo->listAnimals());
        $this->assertSame($this->animalMock, $this->zoo->listAnimals()[0]);
    }
}
