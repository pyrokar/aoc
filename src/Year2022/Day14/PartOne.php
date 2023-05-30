<?php

declare(strict_types=1);

namespace AOC\Year2022\Day14;

use AOC\Util\CompassDirection;
use AOC\Util\Position2D;
use Generator;

class PartOne
{
    /**
     * @param Generator<void, string, void, void> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $sandAtRest = 0;
        $cave = [];
        $maxY = 0;

        foreach ($input as $line) {
            $points = explode(' -> ', $line);

            $l = count($points);
            for ($i = 0; $i < $l - 1; $i++) {
                $p1 = explode(',', $points[$i]);
                $p2 = explode(',', $points[$i+1]);

                if ($p1[1] > $maxY) {
                    $maxY = $p1[1];
                }
                if ($p2[1] > $maxY) {
                    $maxY = $p2[1];
                }

                $start = new Position2D((int) $p1[0], (int) $p1[1]);
                $end = new Position2D((int) $p2[0], (int) $p2[1]);

                if (!isset($cave[$start->getKey()])) {
                    $cave[$start->getKey()] = '#';
                }

                foreach ($start->walkTo($end) as $path) {
                    $cave[$path->getKey()] = '#';
                }
            }
        }

        ++$maxY;

        $currentSandUnit = new Position2D(500, 0);
        while ($currentSandUnit->y < $maxY) {
            $southPosition = $currentSandUnit->getPositionForDirection(CompassDirection::North);
            if (!isset($cave[$southPosition->getKey()])) {
                $currentSandUnit = $southPosition;
                continue;
            }

            $southWestPosition = $southPosition->getPositionForDirection(CompassDirection::West);
            if (!isset($cave[$southWestPosition->getKey()])) {
                $currentSandUnit = $southWestPosition;
                continue;
            }

            $southEastPosition = $southPosition->getPositionForDirection(CompassDirection::East);
            if (!isset($cave[$southEastPosition->getKey()])) {
                $currentSandUnit = $southEastPosition;
                continue;
            }

            // rest
            $cave[$currentSandUnit->getKey()] = 'o';
            $sandAtRest++;
            $currentSandUnit = new Position2D(500, 0);
        }

        return $sandAtRest;
    }

}
