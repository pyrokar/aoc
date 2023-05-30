<?php

declare(strict_types=1);

namespace AOC\Year2022\Day25;

use Generator;

class PartOne
{
    /**
     * @param Generator<void, string, void, void> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): string
    {
        $sum = 0;

        foreach ($input as $line) {
            $sum += snafuToDec($line);
        }

        return decToSnafu($sum);
    }
}
