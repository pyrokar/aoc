<?php

declare(strict_types=1);

namespace AOC\Year2019\Day06;

use AOC\Util\CachedCallableArray;
use Generator;

final class PartOne
{
    /**
     * @param Generator<int, string> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $orbits = new CachedCallableArray();

        foreach ($input as $line) {
            [$a, $b] = explode(')', $line);

            $orbits->set($b, static fn() => $orbits->isset($a) ? $orbits->get($a) + 1 : 1);
        }

        $total = 0;

        foreach ($orbits as $orbitCount) {
            $total += $orbitCount;
        }

        return $total;
    }
}
