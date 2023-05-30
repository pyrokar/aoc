<?php

declare(strict_types=1);

namespace AOC\Year2022\Day01;

use Generator;

class PartTwo
{
    /**
     * @param Generator<void, string, void, void> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $elfs = [];
        $currentElf = 0;

        foreach ($input as $line) {
            if ($line === '') {
                $elfs[] = $currentElf;
                $currentElf = 0;
                continue;
            }

            $currentElf += (int) $line;
        }
        $elfs[] = $currentElf;

        rsort($elfs);

        return $elfs[0] + $elfs[1] + $elfs[2];
    }
}
