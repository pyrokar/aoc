<?php

declare(strict_types=1);

namespace AOC\Year2022\Day02;

use Generator;

class PartOne
{
    /**
     * @param Generator<void, string, void, void> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $loose = 0;
        $draw = 3;
        $won = 6;

        $x = 1;
        $y = 2;
        $z = 3;

        $map = [
            'A X' => $x + $draw,
            'A Y' => $y + $won,
            'A Z' => $z + $loose,
            'B X' => $x + $loose,
            'B Y' => $y + $draw,
            'B Z' => $z + $won,
            'C X' => $x + $won,
            'C Y' => $y + $loose,
            'C Z' => $z + $draw,
        ];

        $score = 0;

        foreach ($input as $line) {
            $score += $map[$line];
        }

        return $score;
    }
}
