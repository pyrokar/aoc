<?php

declare(strict_types=1);

namespace AOC\Year2024\Day03;

use Generator;
use Safe\Exceptions\PcreException;

use function Safe\preg_match_all;
use function str_starts_with;

final class PartTwo
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

        $mulEnabled = true;

        foreach ($input as $line) {
            if (!preg_match_all('/(?<ins>mul\((?<v1>\d{1,3}),(?<v2>\d{1,3})\)|do\(\)|don\'t\(\))/', $line, $matches)) {
                continue;
            }

            foreach ($matches['ins'] as $i => $instruction) {
                if (str_starts_with((string) $instruction, 'mul') && $mulEnabled) {
                    $sum += ((int) $matches['v1'][$i]) * ((int) $matches['v2'][$i]);
                } elseif (str_starts_with((string) $instruction, "don't")) {
                    $mulEnabled = false;
                } elseif (str_starts_with((string) $instruction, 'do')) {
                    $mulEnabled = true;
                }
            }
        }

        return $sum;

    }
}
