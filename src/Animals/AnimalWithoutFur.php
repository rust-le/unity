<?php

namespace Unity\Animals;

use Unity\Animals\AnimalBase;

class AnimalWithoutFur extends AnimalBase
{
    public function __construct(string $name, string $species, callable $eatingBehavior)
    {
        parent::__construct($name, $species, $eatingBehavior);
    }
}
