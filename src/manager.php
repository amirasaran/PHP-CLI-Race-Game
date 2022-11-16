<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';

// There is an area to customize php defaults
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);
ini_set('log_errors', 0);
ini_set('html_errors', 0);


// Create an application instance and run it
$app = new \Actineos\PhpCliRaceGameTest\Library\Core\Kernel();
$app->run();
