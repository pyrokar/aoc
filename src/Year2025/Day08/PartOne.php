<?php

declare(strict_types=1);

namespace AOC\Year2025\Day08;

use Generator;

use function array_map;
use function explode;
use function rsort;

final class PartOne
{
    use Shared;

    /**
     * @param Generator<int, string> $input
     * @param int $connections
     *
     * @return int
     */
    public function __invoke(Generator $input, int $connections): int
    {
        $this->init($input);

        foreach (array_keys($this->distances) as $key) {
            [$circuitA, $circuitB] = explode('-', $key);

            $this->mergeCircuits($circuitA, $circuitB);

            if (--$connections === 0) {
                $sizes = array_map(count(...), $this->circuits);
                rsort($sizes);

                return $sizes[0] * $sizes[1] * $sizes[2];
            }
        }

        return -1;
    }
}
