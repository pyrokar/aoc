<?php

declare(strict_types=1);

namespace AOC\Year2025\Day01;

use Generator;
use Safe\Exceptions\PcreException;

use function Safe\preg_match;

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
        $count = 0;
        $initial = 50;

        foreach ($input as $line) {
            if (!preg_match('/(?<dir>[RL])(?<dist>\d+)/', $line, $m)) {
                continue;
            }

            $distance = (int) $m['dist'];

            $initial = match ($m['dir']) {
                'R' => ($initial + $distance) % 100,
                'L' => ($initial - $distance + 100) % 100,
            };

            if ($initial === 0) {
                $count++;
            }
        }

        return $count;
    }
}
