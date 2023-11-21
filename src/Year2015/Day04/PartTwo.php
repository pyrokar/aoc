<?php

declare(strict_types=1);

namespace AOC\Year2015\Day04;

use Generator;

class PartTwo
{
    /**
     * @param string $secretKey
     *
     * @return int
     */
    public function __invoke(string $secretKey): int
    {
        $i = 0;

        while (true) {
            $test = md5($secretKey . ++$i);

            if (str_starts_with($test, '000000')) {
                return $i;
            }
        }
    }
}
