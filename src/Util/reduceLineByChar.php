<?php

declare(strict_types=1);

namespace AOC\Util;

use Generator;

/**
 * @template R
 *
 * @param Generator<int, string, void, void> | string $input
 * @param callable(R, string): R $callback
 * @param R $initial
 *
 * @return int
 */
function reduceLineByChar(mixed $input, callable $callback, mixed $initial = null): mixed
{
    if ($input instanceof Generator) {
        $line = str_split(rtrim($input->current()));
    } else {
        $line = str_split(rtrim($input));
    }

    return array_reduce($line, $callback, $initial);
}
