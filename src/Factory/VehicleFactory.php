<?php

// This class is not necessary, exists to check YAGNI principle

namespace Actineos\PhpCliRaceGameTest\Factory;

use Actineos\PhpCliRaceGameTest\Object\Vehicle;
use Actineos\PhpCliRaceGameTest\Object\VehicleInterface;

class  VehicleFactory
{
    private object $json;
    private string $name;

    public function __construct(string $name, object $json)
    {
        $this->json = $json;
        $this->name = $name;
    }

    public function create(): VehicleInterface
    {
        return new Vehicle([
            'name' => $this->name,
            'speedValue' => $this->json->speed->value,
            'speedUnit' => $this->json->speed->unit
        ]);
    }
}
