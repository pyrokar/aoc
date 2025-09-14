<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\Empty_\SimplifyEmptyCheckOnEmptyArrayRector;
use Rector\CodeQuality\Rector\If_\ExplicitBoolCompareRector;
use Rector\CodeQuality\Rector\If_\ShortenElseIfRector;
use Rector\CodeQuality\Rector\If_\SimplifyIfElseToTernaryRector;
use Rector\CodeQuality\Rector\If_\SimplifyIfReturnBoolRector;
use Rector\Config\RectorConfig;
use Rector\DeadCode\Rector\ClassMethod\RemoveUselessParamTagRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveUselessReturnTagRector;
use Rector\DeadCode\Rector\Plus\RemoveDeadZeroAndOneOperationRector;
use Rector\Php84\Rector\Param\ExplicitNullableParamTypeRector;
use Rector\Strict\Rector\Empty_\DisallowedEmptyRuleFixerRector;

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
        codeQuality: true,
        typeDeclarations: true,
    )
    ->withSkip([
        // for readability (deadCode)
        RemoveDeadZeroAndOneOperationRector::class,
        RemoveUselessReturnTagRector::class,
        RemoveUselessParamTagRector::class,
        // for readability (codeQuality)
        SimplifyIfElseToTernaryRector::class,
        ExplicitBoolCompareRector::class,
        SimplifyIfReturnBoolRector::class,
        ShortenElseIfRector::class,
        SimplifyEmptyCheckOnEmptyArrayRector::class,
        DisallowedEmptyRuleFixerRector::class,
    ])
    ->withAttributesSets(phpunit: true)
;
