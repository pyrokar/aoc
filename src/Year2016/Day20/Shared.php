<?php

declare(strict_types=1);

namespace AOC\Year2016\Day20;

use Generator;

trait Shared
{
    /**
     * @var array<array<int, int>>
     */
    protected array $blocked;

    /**
     * @param Generator<int, string> $input
     */
    protected function init(Generator $input): void
    {
        $this->blocked = [];

        foreach ($input as $line) {
            [$from, $to] = array_map(static fn(string $a) => (int) $a, explode('-', $line));

            $this->blocked[] = [$from, $to];

        }

        $this->blocked = $this->mergeRange($this->blocked);
    }

    /**
     * @param array<array<int, int>> $ranges
     *
     * @return array<array<int, int>>
     */
    public function mergeRange(array $ranges): array
    {
        usort($ranges, static fn(array $a, array $b) => $a[0] <=> $b[0]);

        $prevIndex = 0;

        for ($i = 1, $c = count($ranges); $i < $c; $i++) {
            if ($ranges[$prevIndex][1] >= $ranges[$i][0] - 1) {
                $ranges[$prevIndex][1] = max($ranges[$prevIndex][1], $ranges[$i][1]);
            } else {
                $prevIndex++;
                $ranges[$prevIndex] = $ranges[$i];
            }
        }

        return array_slice($ranges, 0, $prevIndex + 1);
    }
}
