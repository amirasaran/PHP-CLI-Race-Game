<?php

namespace Actineos\PhpCliRaceGameTest\Exception;

use Exception;

class InvalidDistanceException extends Exception
{
    protected $message = "Invalid distance";
}
