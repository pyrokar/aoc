<?php

declare(strict_types=1);

namespace AOC\Year2023\Day10;

use AOC\Util\CompassDirection;
use AOC\Util\Position2D;
use Exception;
use Generator;

class PartOne
{
    use Shared;

    /**
     * @param Generator<int, string> $input
     *
     * @throws Exception
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        Position2D::invertY();

        $grid = [];
        $start = '';

        foreach ($input as $y => $line) {
            foreach (str_split($line) as $x => $char) {
                $key = Position2D::key($x, $y);
                $grid[$key] = $char;
                if ($char === 'S') {
                    $start = $key;
                }
            }
        }

        $steps = 1;
        $position = null;
        $direction = null;

        foreach (CompassDirection::cases() as $dir) {
            try {
                [$direction, $position] = $this->getNextPosition($dir, Position2D::fromKey($start), $grid);
            } catch (Exception) {
                continue;
            }

            if ($direction) {
                break;
            }
        }

        /**
         * @var CompassDirection $direction
         * @var Position2D $position
         */

        while ($grid[$position->getKey()] !== 'S') {
            [$direction, $position] = $this->getNextPosition($direction, $position, $grid);
            ++$steps;
        }

        return (int) ($steps / 2);
    }

}
