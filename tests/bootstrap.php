<?php

declare(strict_types=1);

use function Safe\define;

if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

require_once __DIR__ . '/../vendor/autoload.php';
