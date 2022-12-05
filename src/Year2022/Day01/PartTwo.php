<?php declare(strict_types=1);

namespace AOC\Year2022\Day01;

use Generator;

use function Safe\preg_match_all;

class PartTwo
{
    /**
     * @param Generator<void, string, void, void> $input
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $elfs = [];
        $currentElf = 0;

        foreach ($input as $line) {
            $i = trim($line);

            if ($i === '') {
                $elfs[] = $currentElf;
                $currentElf = 0;
                continue;
            }

            $currentElf += (int) $i;
        }
        $elfs[] = $currentElf;

        rsort($elfs);

        return $elfs[0] + $elfs[1] + $elfs[2];
    }
}
