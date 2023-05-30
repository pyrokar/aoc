<?php

declare(strict_types=1);

namespace AOC\Util;

use Generator;

/**
 * @template R
 *
 * @param Generator<int, string, void, void> $input
 * @param callable(R, string): R $callback
 * @param R $initial
 *
 * @return int
 */
function reduceInputByLine(Generator $input, callable $callback, mixed $initial = null): mixed
{
    foreach ($input as $line) {
        $line = trim($line);
        if ($line === '') {
            continue;
        }

        $initial = $callback($initial, $line);
    }

    return $initial;
}
