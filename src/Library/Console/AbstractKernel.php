<?php

namespace Actineos\PhpCliRaceGameTest\Library\Console;


use Actineos\PhpCliRaceGameTest\Console\Exception\RequiredKeyIsNotFound;
use samejack\PHP\ArgvParser;

class AbstractKernel
{

    private static array $commands = [];
    private array $arguments;

    /**
     *
     */
    public function __construct()
    {
        $this->arguments = (new ArgvParser())->parseConfigs();
        $this->boot();
    }

    /**
     * @return void
     * boot the kernel
     * this function called after instantiate a new kernel object
     * must time used for registering a new command
     */
    public function boot()
    {
        $this->registerCommand('help', HelpCommand::class);
    }

    /**
     * @return array
     * return all the registered command
     */
    public static function getCommands(): array
    {
        return self::$commands;
    }

    /**
     * @return string|null
     * The first argument of cli command is the router to find
     * the specific command.
     * this function help to find the name of the command
     */
    private function getCommand(): ?string
    {
        return array_key_first($this->arguments);
    }


    /**
     * @param string $name
     * @param string $class
     * @return void
     * This function helps you to register a new command to the kernel
     * this function must be called in the boot function in the Kernel object
     */
    protected function registerCommand(string $name, string $class): void
    {
        self::$commands[strtolower($name)] = $class;
    }

    /***
     * @return void
     * This function will find the requested command
     * and create an instance from this command
     * and then run it
     */
    public function run(): void
    {
        if (php_sapi_name() != 'cli') {
            die('Must run from command line');
        }

        $command = $this->getCommand();
        if (!in_array($command, array_keys(self::$commands))) {
            $command = 'help'; // default command
        }

        /** @var CommandInterface $commandInstance */
        $commandInstance = new self::$commands[$command]();
        $options = $commandInstance->parseArguments($this->arguments);
        if (!is_array($options)) {
            exit(1);
        }
        $commandInstance->handle($options);

    }
}
