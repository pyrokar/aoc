<?php

declare(strict_types=1);

namespace AOC\Year2020\Day03;

use AOC\Util\Position2D;
use Generator;

trait Shared
{
    /**
     * @param array<string, int> $trees
     * @param int $width
     * @param int $height
     * @param int $dx
     * @param int $dy
     *
     * @return int
     */
    protected function getTreesEncountered(array $trees, int $width, int $height, int $dx = 3, int $dy = 1): int
    {
        $treesEncountered = 0;

        for ($y = 0, $x = 0; $y <= $height; $y += $dy, $x = ($x + $dx) % $width) {
            if (isset($trees[Position2D::key($x, $y)])) {
                ++$treesEncountered;
            }
        }

        return $treesEncountered;
    }

    /**
     * @param Generator<int, string> $input
     *
     * @return array<string, int>
     */
    protected function getTrees(Generator $input): array
    {
        $trees = [];

        foreach ($input as $y => $line) {
            foreach (str_split($line) as $x => $char) {
                if ($char === '#') {
                    $trees[Position2D::key($x, $y)] = 1;
                }
            }
        }

        return $trees;
    }
}
