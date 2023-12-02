<?php

declare(strict_types=1);

namespace AOC\Year2023\Day02;

use Generator;
use Safe\Exceptions\PcreException;

use function Safe\preg_match;

class PartTwo
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
        $sumOfPowers = 0;

        foreach ($input as $line) {
            if (!preg_match('/Game (?<id>\d+): (?<sets>.*)/', $line, $m)) {
                continue;
            }

            $sets = explode('; ', $m['sets']);
            $bag = ['red' => 0, 'green' => 0, 'blue' => 0];

            foreach ($sets as $set) {
                $cubes = explode(', ', $set);
                foreach ($cubes as $cube) {
                    [$number, $color] = explode(' ', $cube);
                    if ($bag[$color] < $number) {
                        $bag[$color] = (int) $number;
                    }
                }
            }

            $power = (int) array_product($bag);
            $sumOfPowers += $power;
        }

        return $sumOfPowers;
    }
}
