<?php
declare(strict_types=1);

namespace AOC\Year2015\Day12;

use Generator;
use Safe\Exceptions\PcreException;
use function Safe\preg_match_all;

class PartOne
{
    /**
     * @param Generator<int, string, void, void> $input
     * @return int
     * @throws PcreException
     */
    public function __invoke(Generator $input): int
    {
        $result = 0;

        if (preg_match_all('/-?\d+/', $input->current(), $m)) {
            $result += array_sum($m[0]);
        }

        return (int) $result;
    }
}
