<?php

declare(strict_types=1);

namespace AOC\Year2020\Day03;

use Generator;

class PartOne
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

        return $this->getTreesEncountered($trees, $width, $height);
    }

}
