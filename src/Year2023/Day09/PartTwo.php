<?php

declare(strict_types=1);

namespace AOC\Year2023\Day09;

use Generator;

class PartTwo
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
            $sequence = array_map('intval', explode(' ', $line));

            $sum += $this->getPrevValue($sequence);
        }

        return $sum;
    }

    /**
     * @param list<int> $sequence
     *
     * @return int
     */
    private function getPrevValue(array $sequence): int
    {
        $l = count($sequence);

        $firstValue = $sequence[0];
        $newSequence = [];
        $valuesZero = true;

        for ($i = 1; $i < $l; ++$i) {
            $value = $sequence[$i] - $sequence[$i - 1];
            $newSequence[] = $value;
            if ($value !== 0) {
                $valuesZero = false;
            }
        }

        if ($valuesZero) {
            return $firstValue;
        }

        return $firstValue - $this->getPrevValue($newSequence);
    }
}
