<?php

declare(strict_types=1);

namespace AOC\Year2016\Day03;

use Generator;
use Safe\Exceptions\PcreException;

use function Safe\preg_match;

class PartOne
{
    /**
     * @param Generator<void, string, void, void> $input
     *
     * @throws PcreException
     *
     * @return int
     *
     */
    public function __invoke(Generator $input): int
    {
        $possibleCount = 0;

        foreach ($input as $line) {
            preg_match('/(\d+)\s+(\d+)\s+(\d+)/', trim($line), $m);

            $sides = array_sort([(int) $m[1], (int) $m[2], (int) $m[3]]);

            $possibleCount += ($sides[0] + $sides[1] > $sides[2]) ? 1 : 0;
        }

        return $possibleCount;
    }
}
