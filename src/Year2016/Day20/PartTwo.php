<?php

declare(strict_types=1);

namespace AOC\Year2016\Day20;

use Generator;

class PartTwo
{
    use Shared;

    /**
     * @param Generator<int, string> $input
     * @param int $number
     *
     * @return int
     */
    public function __invoke(Generator $input, int $number): int
    {
        $this->init($input);

        foreach ($this->blocked as $range) {
            $number -= $range[1] - $range[0] + 1;
        }

        return $number;
    }
}
