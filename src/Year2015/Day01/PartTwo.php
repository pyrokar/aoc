<?php

declare(strict_types=1);

namespace AOC\Year2015\Day01;

class PartTwo
{
    /**
     * @param string $input
     *
     * @return int
     */
    public function __invoke(string $input): int
    {
        $floor = 0;
        $position = 0;

        foreach (str_split($input) as $position => $char) {
            if ($char === '(') {
                $floor++;
            } elseif ($char === ')') {
                $floor--;
                if ($floor === -1) {
                    break;
                }
            }
        }

        return $position + 1;
    }
}
