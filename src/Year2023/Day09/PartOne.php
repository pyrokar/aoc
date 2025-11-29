<?php

declare(strict_types=1);

namespace AOC\Year2023\Day09;

use Generator;

class PartOne
{
    /**
     * @param Generator<int, string> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $sum = 0;

        foreach ($input as $line) {
            $sequence = array_map(intval(...), explode(' ', $line));

            $sum += $this->getNextValue($sequence);
        }

        return $sum;
    }

    /**
     * @param list<int> $sequence
     *
     * @return int
     */
    private function getNextValue(array $sequence): int
    {
        $l = count($sequence);

        $lastValue = $sequence[$l - 1];
        $newLastValue = 0;
        $newSequence = [];

        for ($i = 1; $i < $l; ++$i) {
            $newLastValue = $sequence[$i] - $sequence[$i - 1];
            $newSequence[] = $newLastValue;
        }

        if ($newLastValue === 0) {
            return $lastValue;
        }

        return $lastValue + $this->getNextValue($newSequence);
    }
}
