<?php

declare(strict_types=1);

namespace AOC\Year2024\Day02;

trait Shared
{
    /**
     * @param list<int> $levels
     *
     * @return bool
     */
    protected function checkLevels(array $levels): bool
    {
        if (array_unique($levels) !== $levels) {
            return false;
        }

        $increasing = $levels[0] < $levels[1];

        for ($i = 0, $c = count($levels); $i < $c - 1; $i++) {
            $diff = $levels[$i + 1] - $levels[$i];

            if (($increasing && $diff < 1) || (!$increasing && $diff > -1)) {
                return false;
            }

            if (($increasing && $diff > 3) || (!$increasing && $diff < -3)) {
                return false;
            }

        }

        return true;
    }
}
