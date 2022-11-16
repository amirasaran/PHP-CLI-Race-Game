<?php

namespace Actineos\PhpCliRaceGameTest\Unit;

class MphUnit extends AbstractUnit
{
    public function toMetersPerSecond(): float
    {
        return $this->value * 0.44704;
    }
}

//2000/1000 = 2
