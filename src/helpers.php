<?php

if (!function_exists('baseDir')) {
    function baseDir(): string
    {
        return dirname(__DIR__);
    }
}
if (!function_exists('removeExtension')) {
    function removeExtension(string $value): string
    {
        return pathinfo($value, PATHINFO_FILENAME);
    }
}
