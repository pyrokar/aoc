<?php

declare(strict_types=1);

namespace AOC\Year2020\Day01;

use Generator;
use Exception;

class PartOne
{
    /**
     * @param Generator<string> $input
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

        for ($i = 0; $i < $c - 1; ++$i) {
            for ($j = $i + 1; $j < $c; ++$j) {
                if ($numbers[$i] + $numbers[$j] === 2020) {
                    return $numbers[$i] * $numbers[$j];
                }

                if ($numbers[$i] + $numbers[$j] < 2020) {
                    continue 2;
                }
            }
        }

        throw new Exception();
    }
}
