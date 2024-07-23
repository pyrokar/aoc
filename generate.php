<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use AOC\Generator\GenerateCommand;
use Symfony\Component\Console\Application;
use function Safe\define;

if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

$command = new GenerateCommand();

$app = new Application();
$app->add($command);
$app->setDefaultCommand($command->getName(), true);

$app->run();
