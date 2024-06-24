<?php

declare(strict_types=1);

namespace AOC\Year2016\Day20;

use Generator;

class PartOne
{
    use Shared;

    /**
     * @param Generator<int, string> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $this->init($input);

        return $this->blocked[0][1] + 1;
    }
}
