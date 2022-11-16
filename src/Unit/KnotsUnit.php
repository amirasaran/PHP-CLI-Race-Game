<?php

namespace Actineos\PhpCliRaceGameTest\Unit;

class KnotsUnit extends AbstractUnit
{
    public function toMetersPerSecond(): float {
        return ($this->value * 0.514444);
    }
}
