<?php

namespace Actineos\tests\Object;

use Actineos\PhpCliRaceGameTest\Object\Vehicle;
use Actineos\PhpCliRaceGameTest\Repository\VehicleRepository;
use Actineos\PhpCliRaceGameTest\Unit\KmhUnit;
use Actineos\PhpCliRaceGameTest\Unit\KnotsUnit;
use Actineos\PhpCliRaceGameTest\Unit\MphUnit;
use PHPUnit\Framework\TestCase;

final class VehicleTest extends TestCase
{
    /** @test */
    public function test_load_from_array()
    {
        $vehicle = new Vehicle([
            'name' => 'car',
            'speedValue' => 120,
            'speedUnit' => 'kmh'
        ]);
        $this->assertEquals('car', $vehicle->getName());
    }

    /** @test */
    public function test_speed_in_meters_per_second()
    {
        $vehicle = new Vehicle();
        $vehicle->setSpeed(100, 'kmh');
        $this->assertInstanceOf(KmhUnit::class, $vehicle->getSpeed());
        $this->assertEquals($vehicle->getSpeed()->toMetersPerSecond(), (100 * 5) / 18);

        $vehicle2 = new Vehicle();
        $vehicle2->setSpeed(100, 'knots');
        $this->assertInstanceOf(KnotsUnit::class, $vehicle2->getSpeed());
        $this->assertEquals($vehicle2->getSpeed()->toMetersPerSecond(), (100 * 0.514444));

        $vehicle3 = new Vehicle();
        $vehicle3->setSpeed(100, 'mph');
        $this->assertInstanceOf(MphUnit::class, $vehicle3->getSpeed());
        $this->assertEquals($vehicle3->getSpeed()->toMetersPerSecond(), (100 * 0.44704));
    }

    /** @test */
    public function test_vehicle_repository()
    {
        $vehicles = VehicleRepository::all();

        $this->assertIsIterable($vehicles);

        $this->assertEquals(4, count($vehicles));
        foreach ($vehicles as $vehicle) {
            $this->assertInstanceOf(Vehicle::class, $vehicle);
        }
    }
}
