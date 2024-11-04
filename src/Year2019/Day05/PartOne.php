<?php

declare(strict_types=1);

namespace AOC\Year2019\Day05;

use Generator;

use function array_map;
use function explode;

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
        $memory = array_map('intval', explode(',', $input->current()));

        return $this->run($memory, 1);
    }
}
