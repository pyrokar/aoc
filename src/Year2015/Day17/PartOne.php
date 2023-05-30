<?php

declare(strict_types=1);

namespace AOC\Year2015\Day17;

use AOC\Util\Set;
use Generator;

class PartOne
{
    /**
     * @param Generator<int, string, void, void> $input
     * @param int $liters
     *
     * @return int
     */
    public function __invoke(Generator $input, int $liters): int
    {
        $containers = new Set();

        foreach ($input as $line) {
            $containers->addElement((int) $line);
        }

        $combinations = 0;

        foreach ($containers->getCombinations() as $combination) {
            if (array_sum($combination) === $liters) {
                ++$combinations;
            }
        }

        return $combinations;
    }
}
