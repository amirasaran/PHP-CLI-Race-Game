<?php

namespace Actineos\PhpCliRaceGameTest\Unit;

class KmhUnit extends AbstractUnit
{
    public function toMetersPerSecond(): float {
        return ($this->value * 5) / 18;
    }
}
