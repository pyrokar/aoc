<?php

declare(strict_types=1);

namespace AOC\Year2020\Day03;

use Generator;

class PartTwo
{
    use Shared;

    /**
     * @param Generator<int, string> $input
     * @param int $width
     * @param int $height
     *
     * @return int
     */
    public function __invoke(Generator $input, int $width, int $height): int
    {
        $trees = $this->getTrees($input);

        $slopes = [
            [1, 1],
            [3, 1],
            [5, 1],
            [7, 1],
            [1, 2],
        ];

        $treesEncountered = 1;

        foreach ($slopes as $slope) {
            $treesEncountered *= $this->getTreesEncountered($trees, $width, $height, $slope[0], $slope[1]);
        }

        return $treesEncountered;
    }
}
