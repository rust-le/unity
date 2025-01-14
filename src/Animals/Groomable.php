<?php

namespace Unity\Animals;

trait Groomable
{
    public function groom(): void
    {
        echo $this->getName() . " can be groomed.\n";
    }
}
