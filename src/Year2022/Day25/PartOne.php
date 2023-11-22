<?php

declare(strict_types=1);

namespace AOC\Year2022\Day25;

use Generator;

class PartOne
{
    /**
     * @param Generator<string> $input
     *
     * @return string
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
