<?php

declare(strict_types=1);

namespace AOC\Util\Safe;

use ValueError;

/**
 * @template T
 *
 * @param non-empty-array<T> $array
 *
 * @param-out array<T> $array
 *
 * @return T
 */
function array_shift(array &$array): mixed
{
    $safeResult = \array_shift($array);
    if ($safeResult === null) {
        throw new ValueError('Array is empty');
    }

    return $safeResult;
}
