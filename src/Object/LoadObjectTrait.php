<?php

namespace Actineos\PhpCliRaceGameTest\Object;

trait LoadObjectTrait
{
    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }
}
