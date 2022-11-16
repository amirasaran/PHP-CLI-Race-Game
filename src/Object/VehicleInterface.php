<?php

namespace Actineos\PhpCliRaceGameTest\Object;

use Actineos\PhpCliRaceGameTest\Unit\UnitInterface;

interface VehicleInterface
{
    public function setName(string $value): void;

    public function setSpeed(float $value, string $unit): void;

    public function getName(): string;

    public function getSpeed(): UnitInterface;
}
