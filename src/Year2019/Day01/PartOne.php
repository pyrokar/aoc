<?php

declare(strict_types=1);

namespace AOC\Year2019\Day01;

use Generator;

final class PartOne
{
    /**
     * @param Generator<int, string> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $sum = 0;

        foreach ($input as $line) {
            $mass = (int) $line;

            $sum += (int) ($mass / 3) - 2;
        }

        return $sum;
    }
}
