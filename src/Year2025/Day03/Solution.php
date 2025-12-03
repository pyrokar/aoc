<?php

declare(strict_types=1);

namespace AOC\Year2025\Day03;

use Generator;

use function array_merge;
use function array_slice;
use function count;
use function implode;
use function str_split;

final class Solution
{
    /**
     * @param Generator<int, string> $input
     * @param int $length
     *
     * @return int
     */
    public function __invoke(Generator $input, int $length): int
    {
        $total = 0;

        foreach ($input as $line) {
            $batteries = str_split($line);

            $on = array_slice($batteries, 0, $length);

            for ($i = 1, $l = count($batteries) - $length; $i <= $l; $i++) {
                for ($j = 0; $j < $length; $j++) {
                    if ($on[$j] < $batteries[$i + $j]) {
                        $on = array_merge(
                            array_slice($on, 0, $j),
                            array_slice($batteries, $i + $j, $length - $j),
                        );

                        continue 2;
                    }
                }
            }

            $total += (int) implode('', $on);
        }

        return $total;
    }
}
