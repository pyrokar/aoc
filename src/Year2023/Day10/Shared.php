<?php

declare(strict_types=1);

namespace AOC\Year2023\Day10;

use AOC\Util\CompassDirection;
use AOC\Util\Position2D;
use Exception;

trait Shared
{
    /**
     * @param CompassDirection $direction
     * @param Position2D $position
     * @param array<string, string> $grid
     *
     * @throws Exception
     *
     * @return array{?CompassDirection, Position2D}
     */
    protected function getNextPosition(CompassDirection $direction, Position2D $position, array $grid): array
    {
        $nextPosition = $position->getPositionForDirection($direction);

        if (!isset($grid[$nextPosition->getKey()])) {
            throw new Exception();
        }

        $charAtPos = $grid[$nextPosition->getKey()];

        static $nextDirectionBy = [
            CompassDirection::North->value => ['|' => CompassDirection::North, 'F' => CompassDirection::East, '7' => CompassDirection::West],
            CompassDirection::East->value => ['-' => CompassDirection::East, 'J' => CompassDirection::North, '7' => CompassDirection::South],
            CompassDirection::South->value => ['|' => CompassDirection::South, 'L' => CompassDirection::East, 'J' => CompassDirection::West],
            CompassDirection::West->value => ['-' => CompassDirection::West, 'L' => CompassDirection::North, 'F' => CompassDirection::South],
        ];

        return [$nextDirectionBy[$direction->value][$charAtPos] ?? null, $nextPosition];
    }
}
