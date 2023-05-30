<?php

declare(strict_types=1);

namespace AOC\Year2015\Day02;

use Generator;

use function AOC\Util\reduceInputByLine;

class PartTwo
{
    /**
     * @param Generator<int, string, void, void> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        return reduceInputByLine($input, function ($sum, string $line) {

            if (!preg_match('/^(\d+)x(\d+)x(\d+)$/', $line, $matches)) {
                return $sum;
            }

            [, $l, $w, $h] = $matches;

            $mins = array_slice(array_sort([$l, $w, $h]), 0, 2);

            return $sum + (2 * array_sum($mins)) + ($l * $w * $h);

        }, 0);
    }
}
