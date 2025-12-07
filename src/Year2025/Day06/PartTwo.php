<?php

declare(strict_types=1);

namespace AOC\Year2025\Day06;

use Generator;
use Safe\Exceptions\PcreException;

use function array_map;
use function Safe\preg_match_all;
use function str_split;

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
        $total = 0;
        $numbers = [];
        $operators = [];

        foreach ($input as $line) {
            if (preg_match_all('/(?<num>\d+)/', $line, $m)) {
                $numbers[] = str_split($line);
                continue;
            }

            if (preg_match_all('/(?<op>[+*])/', $line, $m)) {
                $operators = str_split($line);
            }
        }

        $numbers2 = array_map(null, ...$numbers);
        $add = 0;
        $mul = 1;
        $op = '+';

        foreach ($numbers2 as $i => $number) {
            $op = empty(trim($operators[$i] ?? '')) ? $op : $operators[$i];
            $n = (int) implode('', $number);

            if ($n === 0) {
                $total += ($op === '+') ? $add : $mul;
                $add = 0;
                $mul = 1;
                continue;
            }

            switch ($op) {
                case '+':
                    $add += $n;
                    break;
                case '*':
                    $mul *= $n;
                    break;

            }
        }

        $total += ($op === '+') ? $add : $mul;

        return $total;
    }
}
