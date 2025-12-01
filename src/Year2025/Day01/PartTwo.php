<?php

declare(strict_types=1);

namespace AOC\Year2025\Day01;

use Generator;
use Safe\Exceptions\PcreException;

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
        $count = 0;
        $initial = 50;

        foreach ($input as $line) {
            if (!\Safe\preg_match('/(?<dir>[RL])(?<dist>\d+)/', $line, $m)) {
                continue;
            }

            $distance = (int) $m['dist'];

            switch ($m['dir']) {
                case 'R':
                    $count += intdiv($initial + $distance, 100);
                    $initial = ($initial + $distance) % 100;
                    break;
                case 'L':
                    $count -= intdiv($initial - 100 - $distance, 100);
                    if ($initial === 0) {
                        $count--;
                    }

                    $initial = ($initial - $distance + 100 * (1 + intdiv($distance, 100))) % 100;
                    break;
            }
        }

        return $count;
    }
}
