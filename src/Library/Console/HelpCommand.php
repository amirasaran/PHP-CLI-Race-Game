<?php

namespace Actineos\PhpCliRaceGameTest\Library\Console;

use Actineos\PhpCliRaceGameTest\Library\Core\Kernel;

class HelpCommand extends AbstractCommand
{

    public function handle(array $options = []): void
    {
        $this->stdout("#################################");
        $this->stdout("Hello welcome to the Actineo Race Game");
        $this->stdout("Available commands:");
        foreach (Kernel::getCommands() as $command => $class) {
            $this->stdout("   - $command");
        }
        $this->stdout("This messages shows because of your request help");
        $this->stdout("or the requested command is not found");
        $this->stdout("#################################");
    }
}
