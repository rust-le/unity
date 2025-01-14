<?php
namespace Unity\Zoo;

use PHPUnit\Framework\TestCase;
use Unity\Animals\Animal;
use Unity\Animals\AnimalBase;

class ZooTest extends TestCase
{
    private Zoo $zoo;
    private Animal $animal;

    protected function setUp(): void
    {
        $this->zoo = new Zoo();
        $this->animal = new AnimalBase('Basia', 'Wiewiórka', function($name, $food) {});
    }

    public function testAddAnimal()
    {
        $this->zoo->addAnimal($this->animal);
        $this->assertCount(1, $this->zoo->listAnimals());
        $this->assertSame($this->animal, $this->zoo->listAnimals()[0]);
    }

    public function testListAnimals()
    {
        $this->assertIsArray($this->zoo->listAnimals());
        $this->assertCount(0, $this->zoo->listAnimals());

        $this->zoo->addAnimal($this->animal);
        $this->assertCount(1, $this->zoo->listAnimals());
        $this->assertSame($this->animal, $this->zoo->listAnimals()[0]);
    }
}
