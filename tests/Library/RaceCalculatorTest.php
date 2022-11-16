<?php

namespace Actineos\tests\Library;

use Actineos\PhpCliRaceGameTest\Library\Race\RaceCalculator;
use Actineos\PhpCliRaceGameTest\Object\Vehicle;
use PHPUnit\Framework\TestCase;

final class RaceCalculatorTest extends TestCase
{
    public function test_it_should_calculate_time_to_finish()
    {
        $vehicle = new Vehicle();
        $vehicle->setSpeed(100, 'kmh');
        $calculator = new RaceCalculator($vehicle, 100);
        $this->assertEquals($calculator->getTimeToFinish(), ((100 * 5) / 18) * 100 );

        $vehicle2 = new Vehicle();
        $vehicle2->setSpeed(100, 'knots');
        $calculator = new RaceCalculator($vehicle2, 100);
        $this->assertEquals($calculator->getTimeToFinish(), (100 * 0.514444) * 100 );


        $vehicle3 = new Vehicle();
        $vehicle3->setSpeed(100, 'mph');
        $calculator = new RaceCalculator($vehicle3, 100);
        $this->assertEquals($calculator->getTimeToFinish(), (100 * 0.44704) * 100 );
    }
}
