<?php

namespace Unity\Zoo;

use PHPUnit\Framework\TestCase;
use ReflectionClass;
use Unity\Animals\Animal;

class ZooTest extends TestCase
{
    private Zoo $zoo;
    private Animal $animalMock;

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

    protected function setUp(): void
    {
        $this->resetZooSingleton();
        $this->zoo = Zoo::create();
        $this->animalMock = $this->createMock(Animal::class);
    }

    private function resetZooSingleton(): void
    {
        $reflection = new ReflectionClass(Zoo::class);
        $instance = $reflection->getProperty('instance');
        $instance->setAccessible(true);
        $instance->setValue(null);
    }
}
