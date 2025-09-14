<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\DeadCode\Rector\ClassMethod\RemoveUselessParamTagRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveUselessReturnTagRector;
use Rector\DeadCode\Rector\Plus\RemoveDeadZeroAndOneOperationRector;
use Rector\Php84\Rector\Param\ExplicitNullableParamTypeRector;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ])
    ->withPhpSets(php83: true)
    ->withRules([
        // non-breaking PHP_84 rules
        ExplicitNullableParamTypeRector::class,
    ])
    ->withPreparedSets(
        deadCode: true,
        typeDeclarations: true,
    )
    ->withSkip([
        // for readability
        RemoveDeadZeroAndOneOperationRector::class,
        RemoveUselessReturnTagRector::class,
        RemoveUselessParamTagRector::class,
    ])
    ->withAttributesSets(phpunit: true)
;
