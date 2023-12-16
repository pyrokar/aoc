<?php

declare(strict_types=1);

namespace AOC\Year2023\Day16;

use AOC\Util\CompassDirection;
use AOC\Util\Position2D;
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

        $this->sendBeam(new Position2D(0, 0), CompassDirection::East);

        return count($this->energized);
    }

}
