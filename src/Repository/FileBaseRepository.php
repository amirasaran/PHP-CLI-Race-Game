<?php

namespace Actineos\PhpCliRaceGameTest\Repository;


abstract class FileBaseRepository implements FileBaseRepositoryInterface
{

    abstract protected static function getFilesPath(): string;

    protected static function getFileOptions(): array
    {
        return array_diff(scandir(static::getFilesPath()), array('..', '.'));
    }

    protected static function getFilePathWithName(string $name): string
    {
        return static::getFilesPath() . '/' . $name;
    }

    protected static function getJsonObject(string $fileName): \stdClass
    {
        $filePath = static::getFilePathWithName($fileName);
        return json_decode(file_get_contents($filePath));
    }

    abstract public static function all(): array;
}
