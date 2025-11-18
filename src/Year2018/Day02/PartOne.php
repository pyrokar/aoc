<?php

declare(strict_types=1);

namespace AOC\Year2018\Day02;

use Generator;

use function str_split;

final class PartOne
{
    /**
     * @param Generator<int, string> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $twos = 0;
        $threes = 0;

        foreach ($input as $line) {
            $chars = [];

            foreach (str_split($line) as $char) {
                $chars[$char] ??= 0;
                $chars[$char]++;
            }

            $counts = [];
            foreach ($chars as $char => $count) {
                $counts[$count][] = $char;
            }

            if (isset($counts[2])) {
                $twos++;
            }

            if (isset($counts[3])) {
                $threes++;
            }
        }

        return $twos * $threes;
    }
}
