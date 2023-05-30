<?php

declare(strict_types=1);

namespace AOC\Year2022\Day08;

use AOC\Util\Position2D;
use Generator;

class PartOne
{
    /**
     * @param Generator<void, string, void, void> $input
     * @param int $gridSize
     *
     * @return int
     */
    public function __invoke(Generator $input, int $gridSize): int
    {
        $grid = [];

        foreach ($input as $y => $line) {
            foreach (str_split($line) as $x => $height) {
                $tree = new Tree($x, $y, (int) $height);
                $grid[$tree->getKey()] = $tree;

                if ($x === 0 || $y === 0) {
                    $tree->isVisible = true;
                    continue;
                }

                if ($x === $gridSize - 1 || $y === $gridSize - 1) {
                    $tree->isVisible = true;
                }
            }
        }

        // from north
        for ($x = 1; $x < $gridSize - 1; $x++) {
            $largestTreeHeight = $grid[Position2D::key($x, 0)]->height;
            for ($y = 1; $y < $gridSize - 1; $y++) {
                $tree = $grid[Position2D::key($x, $y)];

                if ($tree->height > $largestTreeHeight) {
                    $tree->isVisible = true;
                    $largestTreeHeight = $tree->height;
                }
            }
        }

        // from east
        for ($y = 1; $y < $gridSize - 1; $y++) {
            $largestTreeHeight = $grid[Position2D::key($gridSize - 1, $y)]->height;
            for ($x = $gridSize - 2; $x > 0; $x--) {
                $tree = $grid[Position2D::key($x, $y)];

                if ($tree->height > $largestTreeHeight) {
                    $tree->isVisible = true;
                    $largestTreeHeight = $tree->height;
                }
            }
        }

        // from south
        for ($x = 1; $x < $gridSize - 1; $x++) {
            $largestTreeHeight = $grid[Position2D::key($x, $gridSize - 1)]->height;
            for ($y = $gridSize - 2; $y > 0; $y--) {
                $tree = $grid[Position2D::key($x, $y)];

                if ($tree->height > $largestTreeHeight) {
                    $tree->isVisible = true;
                    $largestTreeHeight = $tree->height;
                }
            }
        }

        // from west
        for ($y = 1; $y < $gridSize - 1; $y++) {
            $largestTreeHeight = $grid[Position2D::key(0, $y)]->height;
            for ($x = 1; $x < $gridSize - 1; $x++) {
                $tree = $grid[Position2D::key($x, $y)];

                if ($tree->height > $largestTreeHeight) {
                    $tree->isVisible = true;
                    $largestTreeHeight = $tree->height;
                }
            }
        }


        return count(array_filter($grid, static function (Tree $tree) {
            return $tree->isVisible;
        }));
    }
}
