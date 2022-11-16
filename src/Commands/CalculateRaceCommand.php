<?php

namespace Actineos\PhpCliRaceGameTest\Commands;

use Actineos\PhpCliRaceGameTest\Library\Console\AbstractCommand;
use Actineos\PhpCliRaceGameTest\Library\Race\RaceService;
use Actineos\PhpCliRaceGameTest\Object\Vehicle;
use Actineos\PhpCliRaceGameTest\Repository\VehicleRepository;

/**
 * This the main command for running the game
 */
class CalculateRaceCommand extends AbstractCommand
{

    /**
     * @return void
     * add --number-of-vehicle to command
     * example: php src/manager.php race --number-of-vehicle 4
     */
    protected function boot()
    {
        $this->addOption(
            'number_of_vehicle',
            fn($value) => intval($value),
            'How many vehicles will participate in the race?'
        );
        parent::boot();
    }

    /**
     * @param array $options
     * @return void
     * @throws \Actineos\PhpCliRaceGameTest\Exception\InvalidDistanceException
     */
    public function handle(array $options = []): void
    {
        $numberOfParticipants = $options['number_of_vehicle'];

        $this->stdout('CLI Race Game', self::COLOR_INFO);
        $this->stdout('=============', self::COLOR_SUCCESS);
        $this->stdout("{$numberOfParticipants} vehicle(s) in the race");

        $vehicles = VehicleRepository::all();
        $participates = $this->requestPickVehicles($vehicles, $numberOfParticipants);
        $distance = $this->requestRaceDistance();

        $raceService = new RaceService(array_values($participates), $distance);
        $raceService->race();

        $this->showTable(
            ['name', 'time', 'status'],
            $raceService->toArray()
        );
    }


    /**
     * @param string $msg
     * @return int
     */
    private function requestRaceDistance(string $msg = 'What distance in meters does cover the race?'): int
    {
        $value = $this->prompt($msg, 0, ' ');
        if (!is_numeric($value)) {
            return $this->requestRaceDistance(
                'The distance must be an integer. Again, what distance does cover the race?'
            );
        }

        return (int)$value;
    }

    /**
     * @param Vehicle[] $vehicles
     * @param int $numberOfParticipants
     * @return array
     */
    private function requestPickVehicles(array $vehicles, int $numberOfParticipants): array
    {
        $vehicleNames = array_map(fn($item) => $item->getName(), $vehicles);
        $participates = [];
        foreach (range(1, $numberOfParticipants) as $participateNumber) {
            $selectedIndex = $this->menu(
                $vehicleNames,
                null,
                "Pick a vehicle(Participate Number #{$participateNumber})",
            );
            $participates[$participateNumber] = $vehicles[$selectedIndex];
        }
        return $participates;
    }

}
