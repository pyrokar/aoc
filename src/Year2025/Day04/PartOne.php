<?php

declare(strict_types=1);

namespace AOC\Year2025\Day04;

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
        $rolls = $this->getRolls($input);

        $count = 0;

        foreach ($rolls as $pos) {
            $neighborRolls = 0;
            foreach ($pos->getNeighborKeys() as $neighborKey) {
                if (isset($rolls[$neighborKey])) {
                    $neighborRolls++;
                }
            }

            if ($neighborRolls < 4) {
                $count++;
            }
        }

        return $count;
    }
}
