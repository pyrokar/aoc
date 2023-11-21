<?php

declare(strict_types=1);

namespace AOC\Year2015\Day12;

use Generator;
use Safe\Exceptions\PcreException;

use function Safe\preg_match_all;

class PartOne
{
    /**
     * @param string $input
     *
     * @throws PcreException
     *
     * @return int
     */
    public function __invoke(string $input): int
    {
        $result = 0;

        if (preg_match_all('/-?\d+/', $input, $m)) {
            $result += array_sum($m[0]);
        }

        return (int) $result;
    }
}
