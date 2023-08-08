<?php

declare(strict_types=1);

namespace AOC\Year2015\Day01;

class PartOne
{
    /**
     * @param string $input
     *
     * @return int
     */
    public function __invoke(string $input): int
    {
        $floor = 0;

        foreach (str_split($input) as $char) {
            if ($char === '(') {
                $floor++;
            } elseif ($char === ')') {
                $floor--;
            }
        }

        return $floor;
    }
}
