<?php

declare(strict_types=1);

namespace AOC\Year2019\Day05;

use AOC\Year2019\IntCodeComputer;
use Generator;

use function array_map;
use function explode;

final class Solution
{
    /**
     * @param Generator<int, string> $input
     * @param int $id
     *
     * @return int
     */
    public function __invoke(Generator $input, int $id = 1): int
    {
        $memory = array_map(intval(...), explode(',', $input->current()));

        $icc = new IntCodeComputer($memory, [$id]);

        $icc->execute();

        return $icc->getLastOutput();
    }
}
