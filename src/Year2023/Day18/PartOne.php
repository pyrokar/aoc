<?php

declare(strict_types=1);

namespace AOC\Year2023\Day18;

class PartOne
{
    use Shared;

    /**
     * @param array{dir: string, dist: string, color: string} $m
     *
     * @return array{int, string}
     */
    protected function extract(array $m): array
    {
        return [(int) $m['dist'], $m['dir']];
    }
}
