<?php declare(strict_types=1);

namespace AOC\Year2022\Day01;

use Generator;

use function Safe\preg_match_all;

class PartOne
{
    /**
     * @param Generator<void, string, void, void> $input
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $max = 0;
        $currentElf = 0;

        foreach ($input as $line) {
            if ($line === '') {
                if ($currentElf > $max) {
                    $max = $currentElf;
                }
                $currentElf = 0;
                continue;
            }

            $currentElf += (int) $line;
        }

        return $max;
    }
}
