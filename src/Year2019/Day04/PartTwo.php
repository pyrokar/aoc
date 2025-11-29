<?php

declare(strict_types=1);

namespace AOC\Year2019\Day04;

use function str_split;

final class PartTwo
{
    /**
     * @param int $min
     * @param int $max
     *
     * @return int
     */
    public function __invoke(int $min, int $max): int
    {
        $count = 0;

        for ($number = $min; $number <= $max; $number++) {

            $n = str_split((string) $number);

            $adjacentSame = false;

            for ($i = 0; $i < 5; ++$i) {
                if ($n[$i] > $n[$i + 1]) {
                    continue 2;
                }

                if ($n[$i] === $n[$i + 1]) {
                    if ($i > 0 && $n[$i - 1] === $n[$i]) {
                        continue;
                    }

                    if ($i < 4 && $n[$i + 1] === $n[$i + 2]) {
                        continue;
                    }

                    $adjacentSame = true;
                }
            }

            if (!$adjacentSame) {
                continue;
            }

            $count++;
        }

        return $count;
    }
}
