<?php

namespace Actineos\PhpCliRaceGameTest\Library\Console;

/**
 * To create a new command you must inherit from this class
 * in the commands' folder after that you must register the
 * command in the Console Kernel application inside the boot function
 */
abstract class AbstractCommand implements CommandInterface
{
    const COLOR_SUCCESS = 'success';
    const COLOR_WARNING = 'warning';
    const COLOR_ERROR = 'error';
    const COLOR_INFO = 'info';

    private array $options = [];

    public function __construct()
    {
        $this->boot();
    }

    protected function boot()
    {

    }

    /**
     * @return array
     * return the command required arguments
     */
    public final function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param string $name
     * @param callable|null $cast
     * @param string|null $description
     * @return void
     * add new -- argument to the command
     * this must function used in boot method to register the argument
     */
    public final function addOption(string $name, callable $cast = null, ?string $description = null): void
    {
        $this->options[str_replace('_', '-', $name)] = [
            'cast' => is_callable($cast) ? $cast : fn($value) => strval($value),
            'description' => $description
        ];
    }

    /**
     * @param string $text
     * @param string|null $color
     * @param bool $break
     * @return void
     * print the text in the stdout
     */
    public final function stdout(string $text, ?string $color = null, bool $break = true): void
    {
        if ($break) {
            \cli\line($this->getColoredText($text, $color));
        } else {
            \cli\out($this->getColoredText($text, $color));
        }
    }

    /**
     * @param $text
     * @return void
     * print text in the stderr
     */
    public final function stderr($text): void
    {
        \cli\err($this->getColoredText($text, self::COLOR_ERROR));
    }

    /**
     * @param string $text
     * @param string|null $color
     * @return string
     * Colorize the output of the command for the stderr and stdout
     */
    private function getColoredText(string $text, ?string $color): string
    {
        switch ($color) {
            case null:
                return $text;
            case self::COLOR_INFO:
                return "%b{$text}%n";
            case self::COLOR_SUCCESS:
                return "%g{$text}%n";
            case self::COLOR_ERROR:
                return "%r{$text}%n";
            case self::COLOR_WARNING:
                return "%y{$text}%n";
        }
        if (str_starts_with($color, '%') && strlen($color) == 2) {
            return "{$color}{$text}%n";
        }
        return $text;
    }


    /**
     * @param array $arguments
     * @return array|false
     * This function map the user input arguments of manager.php
     * to the command arguments
     */
    public function parseArguments(array $arguments): array|false
    {
        $options = [];
        $errors = [];
        foreach ($this->options as $key => $config) {
            if (!in_array($key, array_keys($arguments))) {
                $errors[] = "The required argument --{$key} is not present. " . $config['description'] ?? '';
                continue;
            }
            $options[str_replace('-', '_', $key)] = $config['cast']($arguments[$key]);
        }
        if (count($errors) > 0) {
            foreach ($errors as $error) {
                $this->stderr($error);
            }
            $this->stderr("there is some errors in running command");
            return false;
        }
        return $options;
    }

    /**
     * @param array $data
     * @param string|null $default
     * @param string $title
     * @return string
     */
    public function menu(array $data, ?string $default = null, string $title = 'Choose an item'): string
    {
        return \cli\menu($data, $default, $title);
    }

    /**
     * @param string $question
     * @param string|bool $default
     * @param string $marker
     * @param bool $hide
     * @param string|null $color
     * @return string
     */
    public function prompt(string $question, string|bool $default = false, string $marker = ': ', bool $hide = false, ?string $color = null): string
    {
        return \cli\prompt($this->getColoredText($question, $color), $default, $marker, $hide);
    }

    /**
     * @param array $headers
     * @param array $rows
     * @param $renderer
     * @return void
     */
    public function showTable(array $headers, array $rows, $renderer = null)
    {
        if (is_null($renderer)) {
            $cols = [];
            foreach (range(1, count($headers)) as $_) {
                $cols[] = 20;
            }
            $renderer = new \cli\table\Ascii($cols);
        }
        $table = new \cli\Table();
        $table->setHeaders($headers);
        $table->setRows($rows);
        $table->setRenderer($renderer);
        $table->display();
    }
}
