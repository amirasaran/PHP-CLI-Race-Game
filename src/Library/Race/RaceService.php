<?php

namespace Actineos\PhpCliRaceGameTest\Library\Race;

use Actineos\PhpCliRaceGameTest\Exception\InvalidDistanceException;
use Actineos\PhpCliRaceGameTest\Object\RacerObject;
use Actineos\PhpCliRaceGameTest\Object\Vehicle;

class RaceService
{
    /** @var Vehicle[] */
    private array $vehicles;
    private int $distance;
    /** @var RacerObject[] */
    public array $racers;
    public ?RacerObject $winner = null;

    /**
     * @throws InvalidDistanceException
     */
    public function __construct(array $vehicles, int $distance)
    {
        $this->vehicles = $vehicles;
        $this->distance = $distance;

        if ($this->distance <= 0) {
            throw new InvalidDistanceException();
        }

        $this->racers = [];
        $this->setRacers();
    }

    private function setRacers()
    {
        foreach ($this->vehicles as $vehicle) {
            $this->racers[] = new RacerObject([
                'vehicle' => $vehicle
            ]);
        }
    }

    public function race()
    {
        foreach ($this->racers as $racer) {
            $racer->setTimeToFinish(
                (new RaceCalculator($racer->getVehicle(), $this->distance))->getTimeToFinish()
            );

            if (is_null($this->winner) || $this->winner->getTimeToFinish() > $racer->getTimeToFinish()) {
                $this->winner = $racer;
            }
        }
        $this->winner->setWinner();
    }

    public function toArray(): array
    {
        $result = [];
        foreach ($this->racers as $racer) {
            $result[] = [$racer->getVehicle()->getName(), $racer->getRoundedTimeToFinish(), $racer->getStatus()];
        }
        return $result;
    }

}
