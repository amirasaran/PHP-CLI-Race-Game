<?php

namespace Actineos\PhpCliRaceGameTest\Object;

class RacerObject
{
    use LoadObjectTrait;

    private VehicleInterface $vehicle;
    private float $timeToFinish;
    private string $status = 'loser';

    public function getTimeToFinish(): float
    {
        return $this->timeToFinish;
    }

    public function getRoundedTimeToFinish(): float
    {
        return round($this->getTimeToFinish(), 2);
    }

    public function setTimeToFinish($timeToFinish)
    {
        $this->timeToFinish = $timeToFinish;
    }

    public function setVehicle(VehicleInterface $vehicle)
    {
        $this->vehicle = $vehicle;
    }

    public function getVehicle(): VehicleInterface
    {
        return $this->vehicle;
    }

    public function setWinner()
    {
        $this->status = 'winner';
    }

    public function getStatus()
    {
        return $this->status;
    }
}
