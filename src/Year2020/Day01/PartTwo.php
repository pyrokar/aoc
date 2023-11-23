<?php

declare(strict_types=1);

namespace AOC\Year2020\Day01;

use Exception;
use Generator;

class PartTwo
{
    /**
     * @param Generator<int, string> $input
     *
     * @throws Exception
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $numbers = [];

        foreach ($input as $line) {
            $numbers[] = (int) $line;
        }

        rsort($numbers);
        $c = count($numbers);

        for ($i = 0; $i < $c - 2; ++$i) {
            for ($j = $i + 1; $j < $c - 1; ++$j) {
                for ($k = $j + 1; $k < $c; ++$k) {
                    if ($numbers[$i] + $numbers[$j] + $numbers[$k] === 2020) {
                        return $numbers[$i] * $numbers[$j] * $numbers[$k];
                    }

                    if ($numbers[$i] + $numbers[$j] + $numbers[$k] < 2020) {
                        continue 2;
                    }
                }
            }
        }

        throw new Exception();
    }
}
