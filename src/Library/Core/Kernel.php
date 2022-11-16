<?php

namespace Actineos\PhpCliRaceGameTest\Library\Core;

use Actineos\PhpCliRaceGameTest\Commands\CalculateRaceCommand;
use Actineos\PhpCliRaceGameTest\Library\Console\AbstractKernel;

/**
 * This class create console application
 */
class Kernel extends AbstractKernel
{
    /**
     * @return void
     * boot the kernel
     * this function called after instantiate a new kernel object
     * must time used for registering a new command
     */
    public function boot()
    {
        $this->registerCommand('race', CalculateRaceCommand::class);
        parent::boot();
    }
}
