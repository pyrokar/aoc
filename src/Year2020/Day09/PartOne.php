<?php

declare(strict_types=1);

namespace AOC\Year2020\Day09;

use Generator;

class PartOne
{
    /**
     * @param Generator<int, string> $input
     * @param int $preamble
     *
     * @return int
     */
    public function __invoke(Generator $input, int $preamble): int
    {
        $numbers = [];

        foreach ($input as $i => $line) {
            $number = (int) $line;
            $numbers[] = $number;

            if ($i < $preamble) {
                continue;
            }

            for ($j = $i - $preamble; $j < $i - 1; ++$j) {
                for ($k = $j + 1; $k < $i; ++$k) {
                    if ($numbers[$j] + $numbers[$k] === $number) {
                        continue 3;
                    }
                }
            }

            return $number;
        }

        return -1;
    }
}
