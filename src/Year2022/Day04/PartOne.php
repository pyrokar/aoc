<?php

declare(strict_types=1);

namespace AOC\Year2022\Day04;

use Generator;
use Safe\Exceptions\PcreException;

use function Safe\preg_match;

class PartOne
{
    /**
     * @param Generator<void, string, void, void> $input
     *
     * @throws PcreException
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $sum = 0;

        foreach ($input as $line) {
            if (!preg_match('/(?<e1>\d+)-(?<e2>\d+),(?<e3>\d+)-(?<e4>\d+)/', $line, $m)) {
                continue;
            }

            $e1 = (int) $m['e1'];
            $e2 = (int) $m['e2'];
            $e3 = (int) $m['e3'];
            $e4 = (int) $m['e4'];

            if ($e1 >= $e3 && $e2 <= $e4) {
                $sum++;
                continue;
            }

            if ($e2 >= $e4 && $e1 <= $e3) {
                $sum++;
            }
        }

        return $sum;
    }
}
