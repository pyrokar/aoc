<?php

declare(strict_types=1);

namespace AOC\Year2020\Day05;

use Generator;

class PartTwo
{
    use Shared;

    /**
     * @param Generator<int, string> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $seats = array_flip(range(10 * 8 + 5, 110 * 8 + 3));
        foreach ($input as $line) {
            $id = $this->getSeatID($line);
            unset($seats[$id]);
        }

        return array_values(array_flip($seats))[0];
    }
}
