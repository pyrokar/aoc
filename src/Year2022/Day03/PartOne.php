<?php

declare(strict_types=1);

namespace AOC\Year2022\Day03;

use Generator;

use function Safe\preg_match_all;

class PartOne
{
    /**
     * @param Generator<string> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $values = array_flip(array_merge(range('a', 'z'), range('A', 'Z')));

        $sum = 0;

        foreach ($input as $line) {
            $l2 = (int)(strlen($line) / 2);
            $first = substr($line, 0, $l2);
            $second = substr($line, $l2);

            foreach (str_split($second) as $char) {
                if (str_contains($first, $char)) {
                    $sum += $values[$char] + 1;
                    continue 2;
                }
            }
        }

        return $sum;
    }
}
