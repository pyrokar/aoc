<?php

declare(strict_types=1);

namespace AOC\Year2024\Day07;

use AOC\Util\Set;
use Generator;

trait Shared
{
    /**
     * @param Generator $input
     * @param Set<string> $operators
     *
     * @return int
     */
    protected function calculateSum(Generator $input, Set $operators): int
    {
        $sum = 0;

        foreach ($input as $line) {
            [$value, $eq] = explode(': ', (string) $line);
            $value = (int) $value;
            $numbers = array_map('intval', explode(' ', $eq));

            foreach ($operators->getCombinationsWithRepetition(count($numbers) - 1) as $operatorSet) {
                if ($this->isValidEquation($numbers, $operatorSet, $value)) {
                    $sum += $value;
                    continue 2;
                }
            }
        }

        return $sum;
    }
}
