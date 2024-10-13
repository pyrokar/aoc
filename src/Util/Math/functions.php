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

/**
 * @param array<array<int>> $matrix
 *
 * @return int
 */
function calcDeterminant2D(array $matrix): int
{
    return $matrix[0][0] * $matrix[1][1] - $matrix[0][1] * $matrix[1][0];
}

/**
 * @param array<array<int>> $matrix
 *
 * @return int
 */
function calcDeterminant3D(array $matrix): int
{
    return $matrix[0][0] * $matrix[1][1] * $matrix[2][2]
        + $matrix[0][1] * $matrix[1][2] * $matrix[2][0]
        + $matrix[0][2] * $matrix[1][0] * $matrix[2][1]
        - $matrix[0][0] * $matrix[1][2] * $matrix[2][1]
        - $matrix[0][1] * $matrix[1][0] * $matrix[2][2]
        - $matrix[0][2] * $matrix[1][1] * $matrix[2][0]
    ;
}
