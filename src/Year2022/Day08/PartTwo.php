<?php

declare(strict_types=1);

namespace AOC\Year2022\Day08;

use AOC\Util\CompassDirection;
use AOC\Util\Position2D;
use DomainException;
use Generator;
use Safe\Exceptions\PcreException;

class PartTwo
{
    /**
     * @param Generator<int, string> $input
     *
     * @throws PcreException
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
            }
        }

        $scenicScores = [];

        for ($y = 1; $y < $gridSize - 1; $y++) {
            for ($x = 1; $x < $gridSize - 1; $x++) {

                $currentHeight = $grid[Position2D::key($x, $y)]->height;

                $scenicScore = 1;

                foreach (CompassDirection::cases() as $dir) {
                    $position = new Position2D($x, $y);
                    $viewingDistance = 0;
                    while (isset($grid[$position->move($dir, 1)->getKey()])) {
                        $viewingDistance++;
                        if ($grid[$position->getKey()]->height >= $currentHeight) {
                            break;
                        }
                    }

                    $scenicScore *= $viewingDistance;

                }

                $scenicScores[] = $scenicScore;
            }
        }

        if (empty($scenicScores)) {
            throw new DomainException();
        }

        return max($scenicScores);
    }
}
