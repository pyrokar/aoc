<?php

declare(strict_types=1);

namespace AOC\Year2023\Day02;

use Generator;

use Safe\Exceptions\PcreException;

use function Safe\preg_match;

class PartOne
{
    /**
     * @param Generator<string> $input
     *
     * @throws PcreException
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $sumOfIds = 0;

        $bag = [
            'red' => 12,
            'green' => 13,
            'blue' => 14,
        ];

        foreach ($input as $line) {
            if (!preg_match('/Game (?<id>\d+): (?<sets>.*)/', $line, $m)) {
                continue;
            }

            $id = (int) $m['id'];
            $sets = explode('; ', $m['sets']);

            foreach ($sets as $set) {
                $cubes = explode(', ', $set);
                foreach ($cubes as $cube) {
                    [$number, $color] = explode(' ', $cube);
                    if ($bag[$color] < (int) $number) {
                        continue 3;
                    }
                }
            }

            $sumOfIds += $id;
        }


        return $sumOfIds;
    }
}
