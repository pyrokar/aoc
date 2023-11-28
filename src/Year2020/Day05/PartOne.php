<?php

declare(strict_types=1);

namespace AOC\Year2020\Day05;

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
        $maxID = 0;

        foreach ($input as $line) {
            $id = $this->getSeatID($line);
            $maxID = max($maxID, $id);
        }

        return $maxID;
    }
}
