<?php

declare(strict_types=1);

namespace AOC\Year2022\Day02;

use Generator;

class PartTwo
{
    /**
     * @param Generator<void, string, void, void> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $a = 1; // rock
        $b = 2; // paper
        $c = 3; // scissors

        $x = 0;
        $y = 3;
        $z = 6;

        $map = [
            'A X' => $x + $c,
            'A Y' => $y + $a,
            'A Z' => $z + $b,
            'B X' => $x + $a,
            'B Y' => $y + $b,
            'B Z' => $z + $c,
            'C X' => $x + $b,
            'C Y' => $y + $c,
            'C Z' => $z + $a,
        ];

        $score = 0;

        foreach ($input as $line) {
            $score += $map[$line];
        }

        return $score;
    }
}
