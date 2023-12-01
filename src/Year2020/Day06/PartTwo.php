<?php

declare(strict_types=1);

namespace AOC\Year2020\Day06;

use Generator;

class PartTwo
{
    /**
     * @param Generator<string> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $sum = 0;
        $currentQuestions = [];
        $first = true;

        foreach ($input as $line) {
            if ($line === '') {
                $sum += count($currentQuestions);
                $currentQuestions = [];
                $first = true;
                continue;
            }

            $questions = str_split($line);
            if ($first) {
                $currentQuestions = $questions;
            } else {
                $currentQuestions = array_intersect($currentQuestions, $questions);
            }

            $first = false;
        }

        return $sum;
    }
}
