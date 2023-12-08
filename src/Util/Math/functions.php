<?php

declare(strict_types=1);

namespace AOC\Util\Math;

function leastCommonMultiple(int $a, int $b): int
{
    return (int) (abs($a * $b) / greatestCommonDivisor($a, $b));
}

function greatestCommonDivisor(int $a, int $b): int
{
    if ($a < $b) {
        [$a, $b] = [$b, $a];
    }

    while ($b !== 0) {
        $t = $b;
        $b = $a % $b;
        $a = $t;
    }

    return $a;
}
