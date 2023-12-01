<?php

declare(strict_types=1);

namespace AOC\Year2023\Day01;

use Generator;

class PartOne
{
    /**
     * @param Generator<string> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $sum = 0;

        foreach ($input as $line) {
            $numbers = [];

            for ($i = 0, $l = strlen($line); $i < $l; ++$i) {
                if (is_numeric($line[$i])) {
                    $numbers[] = (int) $line[$i];
                }
            }

            $sum += 10 * $numbers[0] + array_pop($numbers);
        }

        return $sum;
    }
}
