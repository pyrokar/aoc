<?php

declare(strict_types=1);

namespace AOC\Year2022\Day20;

use Generator;

class PartOne
{
    /**
     * @param Generator<int, string, void, void> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $numbers = new Numbers();

        foreach ($input as $number) {
            $numbers->append((int) $number);
        }

        $numbers->mix();

        $sum = 0;

        foreach ([1000, 2000, 3000] as $s) {
            $sum += $numbers->getNthNumber($s);
        }

        return $sum;
    }
}
