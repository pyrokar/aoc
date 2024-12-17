<?php

declare(strict_types=1);

namespace AOC\Year2024\Day16;

use Generator;

final class PartOne
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

        return $this->shortestPath();
    }

}
