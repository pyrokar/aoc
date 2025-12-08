<?php

declare(strict_types=1);

namespace AOC\Year2025\Day08;

use Generator;

use function array_values;
use function explode;

final class PartTwo
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

        $totalBoxes = count($this->boxes);

        foreach (array_keys($this->distances) as $key) {
            [$circuitA, $circuitB] = explode('-', $key);

            $this->mergeCircuits($circuitA, $circuitB);

            if (count(array_values($this->circuits)[0]) === $totalBoxes) {
                return $this->boxes[$circuitA]->x * $this->boxes[$circuitB]->x;
            }
        }

        return -1;
    }
}
