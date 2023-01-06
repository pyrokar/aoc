<?php
declare(strict_types=1);

namespace AOC\Year2015\Day01;

use Generator;

class PartTwo
{
    /**
     * @param Generator<int, string, void, void> $input
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $line = $input->current();

        $floor = 0;
        $position = 0;

        foreach (str_split($line) as $position => $char) {
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
