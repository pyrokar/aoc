<?php

declare(strict_types=1);

namespace AOC\Year2024\Day13;

use Generator;
use Safe\Exceptions\PcreException;

use function count;
use function is_int;

final class Solution
{
    /**
     * @param Generator<int, string> $input
     * @param int $add
     *
     * @throws PcreException
     *
     * @return int
     */
    public function __invoke(Generator $input, int $add = 0): int
    {
        $token = 0;

        $machine = [];

        foreach ($input as $line) {
            if (\Safe\preg_match('/Button (?<b>\w): X\+(?<x>\d+), Y\+(?<y>\d+)/', $line, $m)) {
                $machine[$m['b']] = ['x' => (int) $m['x'], 'y' => (int) $m['y']];
                continue;
            }

            if (\Safe\preg_match('/Prize: X=(?<x>\d+), Y=(?<y>\d+)/', $line, $m)) {
                $machine['P'] = ['x' => $add + (int) $m['x'], 'y' => $add + (int) $m['y']];
            }

            if (count($machine) === 3) {

                $token += $this->tokenSpend($machine);

                $machine = [];
            }
        }

        return $token;
    }

    /**
     * @param array<string, array<string, int>> $m
     *
     * @return int
     */
    private function tokenSpend(array $m): int
    {
        $d = ($m['B']['x'] * $m['A']['y'] - $m['B']['y'] * $m['A']['x']);

        if ($d === 0) {
            return 0;
        }

        $b = ($m['P']['x'] * $m['A']['y'] - $m['P']['y'] * $m['A']['x']) / $d;

        $a = ($m['P']['x'] - $b * $m['B']['x']) / $m['A']['x'];

        if (!is_int($a) || !is_int($b) || $a < 0 || $b < 0) {
            return 0;
        }

        return 3 * $a + $b;
    }
}
