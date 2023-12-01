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
            $first = 0;
            $firstFound = false;
            $last = 0;
            $lastFound = false;

            $l = strlen($line);

            for ($i = 0; $i < $l; ++$i) {
                if ($firstFound && $lastFound) {
                    break;
                }

                if (is_numeric($line[$i]) && !$firstFound) {
                    $first = (int) ($line[$i]);
                    $firstFound = true;
                }

                if (is_numeric($line[$l - $i - 1]) && !$lastFound) {
                    $last = (int) ($line[$l - $i - 1]);
                    $lastFound = true;
                }
            }

            $sum += 10 * $first + $last;
        }

        return $sum;
    }
}
