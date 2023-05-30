<?php

declare(strict_types=1);

namespace AOC\Year2022\Day20;

use Generator;

class PartTwo
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
            $numbers->append((int) $number * 811589153);
        }

        for ($i = 0; $i < 10; $i++) {
            $numbers->mix();
        }

        $sum = [];

        foreach ([1000, 2000, 3000] as $s) {
            $sum[] = $numbers->getNthNumber($s);
        }

        return array_sum($sum);
    }
}
