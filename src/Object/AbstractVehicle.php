<?php

namespace Actineos\PhpCliRaceGameTest\Object;

use Actineos\PhpCliRaceGameTest\Exception\InvalidUnitException;
use Actineos\PhpCliRaceGameTest\Unit\KmhUnit;
use Actineos\PhpCliRaceGameTest\Unit\KnotsUnit;
use Actineos\PhpCliRaceGameTest\Unit\MphUnit;
use Actineos\PhpCliRaceGameTest\Unit\UnitInterface;

abstract class AbstractVehicle implements VehicleInterface
{
    protected string $name;
    protected float $speedValue;
    protected string $speedUnit;

    public function setName(string $value): void
    {
        $this->name = $value;
    }

    public function setSpeed(float $value, string $unit): void
    {
        $this->speedValue = $value;
        $this->speedUnit = $unit;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @throws InvalidUnitException
     */
    public function getSpeed(): UnitInterface
    {
        return match ($this->speedUnit) {
            'knots' => new KnotsUnit($this->speedValue),
            'kmh' => new KmhUnit($this->speedValue),
            'mph' => new MphUnit($this->speedValue),
            default => throw new InvalidUnitException(
                "The requested unit({$this->speedUnit}) is not a valid choices."
            ),
        };
    }
}
