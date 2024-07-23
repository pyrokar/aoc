<?php

declare(strict_types=1);

namespace AOC\Year2019\Day01;

use Generator;

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

        foreach ($input as $line) {
            $mass = (int) $line;
            $requiredFuel = (int) ($mass / 3) - 2;

            while ($requiredFuel >= 0) {
                $sum += $requiredFuel;

                $requiredFuel = (int) ($requiredFuel / 3) - 2;
            }
        }

        return $sum;
    }
}
