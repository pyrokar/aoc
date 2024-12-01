<?php

declare(strict_types=1);

namespace AOC\Year2024\Day01;

use Generator;

use function array_map;
use function explode;

final class PartTwo
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
            $listL[$l] = ($listL[$l] ?? 0) + 1;
            $listR[$r] = ($listR[$r] ?? 0) + 1;
        }

        foreach ($listL as $l => $count) {
            if (isset($listR[$l])) {
                $sum += $l * $listR[$l] * $count;
            }
        }

        return $sum;
    }
}
