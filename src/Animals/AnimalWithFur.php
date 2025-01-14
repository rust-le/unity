<?php

namespace Unity\Animals;

use Unity\Animals\AnimalBase;

class AnimalWithFur extends AnimalBase
{
    use Groomable;

    public function __construct(string $name, string $species, callable $eatingBehavior)
    {
        parent::__construct($name, $species, $eatingBehavior);
    }

}
