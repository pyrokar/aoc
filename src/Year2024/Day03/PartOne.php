<?php

declare(strict_types=1);

namespace AOC\Year2024\Day03;

use Generator;
use Safe\Exceptions\PcreException;

use function Safe\preg_match_all;

final class PartOne
{
    /**
     * @param Generator<int, string> $input
     *
     * @throws PcreException
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $sum = 0;

        foreach ($input as $line) {
            if (!preg_match_all('/mul\((?<v1>\d{1,3}),(?<v2>\d{1,3})\)/', $line, $matches)) {
                continue;
            }

            foreach ($matches['v1'] as $i => $v1) {
                $sum += ((int) $v1) * ((int) $matches['v2'][$i]);
            }
        }

        return $sum;
    }
}
