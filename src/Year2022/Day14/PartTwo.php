<?php

declare(strict_types=1);

namespace AOC\Year2022\Day14;

use AOC\Util\CompassDirection;
use AOC\Util\Position2D;
use Generator;

class PartTwo
{
    /** @var array<string, string> */
    private array $cave;

    /**
     * @param Generator<void, string, void, void> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $sandAtRest = 0;
        $this->cave = [];
        $maxY = 0;

        foreach ($input as $line) {
            $points = explode(' -> ', $line);

            $l = count($points);
            for ($i = 0; $i < $l - 1; $i++) {
                $p1 = explode(',', $points[$i]);
                $p2 = explode(',', $points[$i + 1]);

                if ($p1[1] > $maxY) {
                    $maxY = (int) $p1[1];
                }

                if ($p2[1] > $maxY) {
                    $maxY = (int) $p2[1];
                }

                $start = new Position2D((int) $p1[0], (int) $p1[1]);
                $end = new Position2D((int) $p2[0], (int) $p2[1]);

                $this->drawLine($start, $end);
            }
        }

        $maxY += 2;

        $this->drawLine(new Position2D(500 - $maxY - 4, $maxY), new Position2D(500 + $maxY, $maxY + 4));

        $currentSandUnit = new Position2D(500, 0);
        while (true) {
            $southPosition = $currentSandUnit->getPositionForDirection(CompassDirection::North);
            if (!isset($this->cave[$southPosition->getKey()])) {
                $currentSandUnit = $southPosition;
                continue;
            }

            $southWestPosition = $southPosition->getPositionForDirection(CompassDirection::West);
            if (!isset($this->cave[$southWestPosition->getKey()])) {
                $currentSandUnit = $southWestPosition;
                continue;
            }

            $southEastPosition = $southPosition->getPositionForDirection(CompassDirection::East);
            if (!isset($this->cave[$southEastPosition->getKey()])) {
                $currentSandUnit = $southEastPosition;
                continue;
            }

            // rest
            $this->cave[$currentSandUnit->getKey()] = 'o';
            $sandAtRest++;

            if ($currentSandUnit->getKey() === '(500|0)') {
                break;
            }

            $currentSandUnit = new Position2D(500, 0);
        }

        return $sandAtRest;
    }

    private function drawLine(Position2D $start, Position2D $end): void
    {
        if (!isset($this->cave[$start->getKey()])) {
            $this->cave[$start->getKey()] = '#';
        }

        foreach ($start->walkTo($end) as $path) {
            $this->cave[$path->getKey()] = '#';
        }
    }
}
