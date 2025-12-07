<?php

declare(strict_types=1);

namespace AOC\Year2025\Day06;

use Generator;
use Safe\Exceptions\PcreException;

use function array_map;
use function array_product;
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
        $total = 0;

        $numbers = [];

        foreach ($input as $line) {
            if (preg_match_all('/(?<num>\d+)/', $line, $m)) {
                $numbers[] = array_map(intval(...), $m['num']);

                continue;
            }

            if (preg_match_all('/(?<op>[+*])/', $line, $m)) {
                $numbers = array_map(null, ...$numbers);

                foreach ($m['op'] as $column => $operator) {
                    $total += match ($operator) {
                        '*' => array_product($numbers[$column]),
                        '+' => array_sum($numbers[$column]),
                    };
                }

            }

        }

        return $total;
    }
}
