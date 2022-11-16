<?php

namespace Actineos\PhpCliRaceGameTest\Unit;

abstract class AbstractUnit implements UnitInterface
{
    protected float $value;

    public function __construct(float $value)
    {
        $this->value = $value;
    }
}
