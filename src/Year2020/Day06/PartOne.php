<?php

declare(strict_types=1);

namespace AOC\Year2020\Day06;

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
        $sum  = 0;
        $currentQuestions = [];

        foreach ($input as $line) {
            if ($line === '') {
                $sum += count($currentQuestions);
                $currentQuestions = [];
                continue;
            }

            foreach (str_split($line) as $question) {
                $currentQuestions[$question] = 1;
            }
        }

        return $sum;
    }
}
