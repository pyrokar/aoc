<?php

declare(strict_types=1);

namespace AOC\Year2025\Day01;

use Generator;
use Safe\Exceptions\PcreException;

use function Safe\preg_match;

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
        $dialValue = 50;

        foreach ($input as $line) {
            if (!preg_match('/(?<dir>[RL])(?<dist>\d+)/', $line, $m)) {
                continue;
            }

            $distance = (int) $m['dist'];

            switch ($m['dir']) {
                case 'R':
                    $count += intdiv($dialValue + $distance, 100);
                    $dialValue = ($dialValue + $distance) % 100;
                    break;
                case 'L':
                    $count -= intdiv($dialValue - 100 - $distance, 100);
                    if ($dialValue === 0) {
                        $count--;
                    }

                    $dialValue = ($dialValue - $distance) % 100;
                    if ($dialValue < 0) {
                        $dialValue += 100;
                    }

                    break;
            }
        }

        return $count;
    }
}
