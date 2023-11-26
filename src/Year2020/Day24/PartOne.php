<?php

declare(strict_types=1);

namespace AOC\Year2020\Day24;

use Generator;

class PartOne
{
    use Shared;

    /**
     * @param Generator<string> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $blackTiles = $this->getBlackTilesForInput($input);

        return count($blackTiles);
    }

}
