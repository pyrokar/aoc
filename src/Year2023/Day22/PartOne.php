<?php

declare(strict_types=1);

namespace AOC\Year2023\Day22;

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
        $this->letThemFall($input);

        return count($this->getDisintegratedBricks());
    }

}
