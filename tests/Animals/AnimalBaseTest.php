<?php
namespace Unity\Animals;

use PHPUnit\Framework\TestCase;

class AnimalBaseTest extends TestCase
{
    private string $name;
    private string $species;

    protected function setUp(): void
    {
        $this->name = 'Basia';
        $this->species = 'Wiewiórka';
        $this->eatingBehavior = function($name, $food) {};
    }
    public function test__construct()
    {
        $animal = new AnimalBase($this->name, $this->species, $this->eatingBehavior);
        $this->assertInstanceOf(Animal::class, $animal);
        $this->assertInstanceOf(AnimalBase::class, $animal);
    }

    public function testGetGetters()
    {
        $animal = new AnimalBase($this->name, $this->species, $this->eatingBehavior);
        $this->assertEquals($this->name, $animal->getName());
        $this->assertEquals($this->species, $animal->getSpecies());
    }

    public function testEat()
    {
      // TODO: Implement testEat() method.
    }

    public function test__toString()
    {
        $animal = new AnimalBase($this->name, $this->species, $this->eatingBehavior);
        $this->assertEquals('Wiewiórka Basia', (string)$animal);
    }
}
