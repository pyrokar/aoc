<?php

declare(strict_types=1);

namespace AOC\Year2025\Day05;

use Generator;
use Safe\Exceptions\PcreException;

use function array_reduce;
use function count;
use function max;

final class PartTwo
{
    /**
     * @param Generator<int, string> $input
     *
     * @throws PcreException
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $ranges = [];

        foreach ($input as $line) {
            if (\Safe\preg_match('/(?<from>\d+)-(?<to>\d+)/', $line, $m)) {
                $from = (int) $m['from'];
                $to = (int) $m['to'];

                $ranges[] = [$from, $to];
            }
        }

        usort($ranges, static fn(array $a, array $b): int => $a[0] <=> $b[0]);

        $hasMerged = true;

        while ($hasMerged) {
            $hasMerged = false;
            $mergedRanges = [];

            for ($i = 0, $l = count($ranges); $i < $l; $i++) {
                if (!isset($ranges[$i + 1]) || $ranges[$i][1] < $ranges[$i + 1][0] - 1) {
                    $mergedRanges[] = $ranges[$i];
                    continue;
                }

                $mergedRanges[] = [$ranges[$i][0], max($ranges[$i][1], $ranges[$i + 1][1])];
                $i++;
                $hasMerged = true;
            }

            $ranges = $mergedRanges;
        }

        return array_reduce($ranges, static fn($sum, $range): float|int => $sum + $range[1] - $range[0] + 1, 0);
    }
}
