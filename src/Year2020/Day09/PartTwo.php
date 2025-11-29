<?php

declare(strict_types=1);

namespace AOC\Year2020\Day09;

use Generator;

class PartTwo
{
    /**
     * @param Generator<int, string> $input
     * @param int $preamble
     *
     * @return int
     */
    public function __invoke(Generator $input, int $preamble): int
    {
        $weakNumber = 0;
        $numbers = [];

        foreach ($input as $i => $line) {
            $number = (int) $line;
            $numbers[] = $number;
            if ($i < $preamble) {
                continue;
            }

            if ($weakNumber !== 0) {
                continue;
            }

            for ($j = $i - $preamble; $j < $i - 1; ++$j) {
                for ($k = $j + 1; $k < $i; ++$k) {
                    if ($numbers[$j] + $numbers[$k] === $number) {
                        continue 3;
                    }
                }
            }

            $weakNumber = $number;
        }

        for ($i = 0, $l = count($numbers); $i < $l; ++$i) {
            $sum = 0;
            for ($j = $i; $j < $l; ++$j) {
                $sum += $numbers[$j];

                if ($sum === $weakNumber) {
                    $set = array_splice($numbers, $i, $j - $i);
                    sort($set);

                    return $set[0] + array_pop($set);
                }

                if ($sum > $weakNumber) {
                    continue 2;
                }
            }
        }

        return -1;

    }
}
