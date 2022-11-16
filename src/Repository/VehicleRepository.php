<?php

namespace Actineos\PhpCliRaceGameTest\Repository;

use Actineos\PhpCliRaceGameTest\Object\Vehicle;

class VehicleRepository extends FileBaseRepository
{
    const VEHICLE_PATH = '/data/vehicles';

    public static function getFilesPath(): string
    {
        return baseDir() . self::VEHICLE_PATH;
    }

    public static function all(): array
    {
        $objects = [];
        foreach (self::getVehicleOptions() as $vehicleOption) {
            $jsonData = self::getJsonObject($vehicleOption);
            $objects[] = new Vehicle([
                'name' => removeExtension($vehicleOption),
                'speedValue' => $jsonData->speed->value,
                'speedUnit' => $jsonData->speed->unit,
            ]);
        }
        return $objects;
    }
}
