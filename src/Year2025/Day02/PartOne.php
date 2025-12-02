<?php

declare(strict_types=1);

namespace AOC\Year2025\Day02;

use Safe\Exceptions\PcreException;

use function Safe\preg_match;

final class PartOne
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
        $ranges = explode(',', $input);

        $count = 0;

        foreach ($ranges as $range) {
            [$from, $to] = explode('-', $range);
            $from = (int) $from;
            $to = (int) $to;

            for ($n = $from; $n <= $to; $n++) {
                if (preg_match('/^(\d+)(=?\1)$/', (string) $n)) {
                    $count += $n;
                }
            }
        }

        return $count;
    }
}
