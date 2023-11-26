<?php

declare(strict_types=1);

namespace AOC\Year2016\Day01;

use AOC\Util\CompassDirection;
use AOC\Util\Position2D;
use Generator;
use RuntimeException;
use Safe\Exceptions\PcreException;

use function Safe\preg_match;

class PartOne
{
    /**
     * @param Generator<string> $input
     *
     * @throws PcreException
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $currentDirection = CompassDirection::North;

        $position = new Position2D(0, 0);

        $directions = explode(', ', $input->current());

        foreach ($directions as $direction) {
            preg_match('/([LR])(\d+)/', $direction, $m);

            $currentDirection = match ($m[1]) {
                'L' => $currentDirection->turnLeft(),
                'R' => $currentDirection->turnRight(),
                default => throw new RuntimeException(),
            };

            $position->move($currentDirection, (int) $m[2]);
        }

        return $position->calcManhattanDistanceTo(new Position2D(0, 0));
    }
}
