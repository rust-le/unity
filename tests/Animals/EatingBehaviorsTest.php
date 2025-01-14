<?php

namespace Unity\Animals;

use PHPUnit\Framework\TestCase;

class EatingBehaviorsTest extends TestCase
{
    public function testCarnivorous()
    {
        $this->expectOutputString("Leo eats the meat.\n");
        EatingBehaviors::carnivorous('Leo', 'meat');
    }

    public function testCarnivorousRefuses()
    {
        $this->expectOutputString("Leo refuses to eat plant.\n");
        EatingBehaviors::carnivorous('Leo', 'plant');
    }

    public function testHerbivorous()
    {
        $this->expectOutputString("Dumbo eats the plant.\n");
        EatingBehaviors::herbivorous('Dumbo', 'plant');
    }

    public function testHerbivorousRefuses()
    {
        $this->expectOutputString("Dumbo refuses to eat meat.\n");
        EatingBehaviors::herbivorous('Dumbo', 'meat');
    }

    public function testOmnivorous()
    {
        $this->expectOutputString("Baloo eats the meat.\n");
        EatingBehaviors::omnivorous('Baloo', 'meat');
    }

    public function testOmnivorousEatsPlant()
    {
        $this->expectOutputString("Baloo eats the plant.\n");
        EatingBehaviors::omnivorous('Baloo', 'plant');
    }

    public function testOmnivorousRefuses()
    {
        $this->expectOutputString("Baloo refuses to eat insects.\n");
        EatingBehaviors::omnivorous('Baloo', 'insects');
    }
}
