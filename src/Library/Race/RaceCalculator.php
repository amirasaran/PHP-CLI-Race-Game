<?php

namespace Actineos\PhpCliRaceGameTest\Library\Race;

use Actineos\PhpCliRaceGameTest\Object\VehicleInterface;

class RaceCalculator
{
    private int $distance;

    private VehicleInterface $vehicle;

    public function __construct(VehicleInterface $vehicle, int $distance)
    {
        $this->vehicle = $vehicle;
        $this->distance = $distance;
    }

    public function getTimeToFinish(): float
    {
        return $this->vehicle->getSpeed()->toMetersPerSecond() * $this->distance;
    }
}
