<?php

declare(strict_types=1);

namespace AOC\Year2024\Day11;

use function array_map;
use function explode;
use function strlen;
use function substr;

final class Solution
{
    /**
     * @var array<int, array<int, int>>
     */
    private array $cache;

    /**
     * @param string $input
     * @param int $times
     *
     * @return int
     */
    public function __invoke(string $input, int $times): int
    {
        $stones = array_map(intval(...), explode(' ', $input));

        $this->cache = [];

        $sum = 0;

        foreach ($stones as $stone) {
            $sum += $this->getStones($stone, $times);
        }

        return $sum;
    }

    private function getStones(int $stone, int $times): int
    {
        if ($times === 0) {
            return 1;
        }

        if (isset($this->cache[$stone][$times])) {
            return $this->cache[$stone][$times];
        }

        $countStones = 0;

        if ($stone === 0) {
            $countStones += $this->getStones(1, $times - 1);
        } else {
            $l = strlen((string) $stone);
            if ($l % 2 === 0) {
                $countStones += $this->getStones((int) substr((string) $stone, 0, (int) ($l / 2)), $times - 1);
                $countStones += $this->getStones((int) substr((string) $stone, (int) ($l / 2)), $times - 1);
            } else {
                $countStones += $this->getStones($stone * 2024, $times - 1);
            }
        }

        $this->cache[$stone][$times] = $countStones;

        return $countStones;
    }
}
