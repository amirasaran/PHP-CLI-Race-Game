<?php

namespace Actineos\PhpCliRaceGameTest\Library\Console;

interface CommandInterface
{

    /**
     * @param array $options
     * @return void
     * This is the main function run after create
     * command instance to start your function
     */
    public function handle(array $options = []): void;

    /**
     * @return array
     * return the command required arguments
     */
    public function getOptions(): array;

    /**
     * @param string $name
     * @param callable|null $cast
     * @param string|null $description
     * @return void
     * add new -- argument to the command
     * this must function used in boot method to register the argument
     */
    public function addOption(string $name, callable $cast = null, ?string $description = null): void;

    /**
     * @param string $text
     * @param string|null $color
     * @param bool $break
     * @return void
     * print the text in the stdout
     */
    public function stdout(string $text, ?string $color = null, bool $break = false): void;

    /**
     * @param $text
     * @return void
     * print text in the stderr
     */
    public function stderr($text): void;
}
