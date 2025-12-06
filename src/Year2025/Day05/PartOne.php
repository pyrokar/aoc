<?php

declare(strict_types=1);

namespace AOC\Year2025\Day05;

use Generator;
use Safe\Exceptions\PcreException;

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
        $ranges = [];
        $fresh = 0;

        foreach ($input as $line) {
            if (\Safe\preg_match('/(?<from>\d+)-(?<to>\d+)/', $line, $m)) {
                $from = (int) $m['from'];
                $to = (int) $m['to'];

                $ranges[] = [$from, $to];

                continue;
            }

            if (\Safe\preg_match('/(?<id>\d+)/', $line, $m)) {
                $id = (int) $m['id'];

                foreach ($ranges as $range) {
                    if ($range[0] <= $id && $id <= $range[1]) {
                        $fresh++;
                        continue 2;
                    }
                }
            }

        }

        return $fresh;
    }
}
