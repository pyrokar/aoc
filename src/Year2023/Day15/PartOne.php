<?php

declare(strict_types=1);

namespace AOC\Year2023\Day15;

use Generator;

class PartOne
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
            $value = 0;

            foreach (str_split($line) as $char) {
                $value += ord($char);
                $value = ($value * 17) % 256;
            }

            $sum += $value;
        }

        return $sum;
    }
}
