<?php

declare(strict_types=1);

namespace AOC\Year2024\Day01;

use Generator;

use function array_map;
use function explode;

final class PartOne
{
    /**
     * @param Generator<int, string> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $sum = 0;

        $listL = [];
        $listR = [];

        foreach ($input as $line) {
            [$l, $r] = array_map('intval', explode('   ', $line));

            $listL[] = $l;
            $listR[] = $r;
        }

        sort($listL);
        sort($listR);

        foreach ($listL as $i => $l) {
            $sum += abs($l - $listR[$i]);
        }

        return $sum;
    }
}
