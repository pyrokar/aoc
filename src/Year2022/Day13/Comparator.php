<?php

declare(strict_types=1);

namespace AOC\Year2022\Day13;

trait Comparator
{
    private function compare(array $first, array $second): int
    {
        for ($i = 0; $i >= 0; $i++) {
            if (!isset($first[$i]) && !isset($second[$i])) {
                return 0;
            }

            if (!isset($first[$i])) {
                return -1;
            }

            if (!isset($second[$i])) {
                return 1;
            }

            $firstValue = $first[$i];
            $secondValue = $second[$i];

            if (!is_array($firstValue) && !is_array($secondValue)) {
                if ($firstValue === $secondValue) {
                    continue;
                }

                if ($firstValue < $secondValue) {
                    return -1;
                }

                if ($firstValue > $secondValue) {
                    return 1;
                }
            }

            if (!is_array($firstValue)) {
                $firstValue = [$firstValue];
            }

            if (!is_array($secondValue)) {
                $secondValue = [$secondValue];
            }

            $ret = $this->compare($firstValue, $secondValue);

            if ($ret === 0) {
                continue;
            }

            return $ret;
        }

        return 0;
    }
}
