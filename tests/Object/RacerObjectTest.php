<?php

namespace Actineos\tests\Object;

use Actineos\PhpCliRaceGameTest\Object\RacerObject;
use Actineos\PhpCliRaceGameTest\Object\Vehicle;
use Actineos\PhpCliRaceGameTest\Unit\KmhUnit;
use PHPUnit\Framework\TestCase;

final class RacerObjectTest extends TestCase
{
    /** @test */
    public function test_it_load_from_array()
    {
        $vehicle = new Vehicle([
            'name' => 'boat',
            'speedValue' => 100,
            'speedUnit' => 'kmh'
        ]);
        $race = new RacerObject([
            'vehicle' => $vehicle,
        ]);
        $this->assertEquals($race->getVehicle(), $vehicle);
        $this->assertInstanceOf(KmhUnit::class, $vehicle->getSpeed());
    }
}
