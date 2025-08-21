<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Php84\Rector\Param\ExplicitNullableParamTypeRector;
use Rector\Set\ValueObject\SetList;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ])
    ->withSets([SetList::PHP_83])
    ->withRules([
        // non-breaking PHP_84 rules
        ExplicitNullableParamTypeRector::class,
    ])
    ->withAttributesSets(phpunit: true)
;
