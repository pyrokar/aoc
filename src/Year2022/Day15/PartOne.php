<?php

declare(strict_types=1);

namespace AOC\Year2022\Day15;

use AOC\Util\Position2D;
use Generator;

class PartOne
{
    /**
     * @param Generator<void, string, void, void> $input
     * @param int $rowY
     *
     * @return int
     */
    public function __invoke(Generator $input, int $rowY): int
    {
        $row = [];

        foreach ($input as $line) {

            if (!preg_match('/Sensor at x=(?<sx>-?\d+), y=(?<sy>-?\d+): closest beacon is at x=(?<bx>-?\d+), y=(?<by>-?\d+)/', $line, $m)) {
                continue;
            }

            $sensor = new Position2D((int) $m['sx'], (int) $m['sy']);
            if ($sensor->y === $rowY) {
                $row[$sensor->getKey()] = 'S';
            }

            $beacon = new Position2D((int) $m['bx'], (int) $m['by']);
            if ($beacon->y === $rowY) {
                $row[$beacon->getKey()] = 'B';
            }

            $sensorRadius = $sensor->calcManhattanDistanceTo($beacon);

            $pointOnRow = new Position2D($sensor->x, $rowY);
            $distanceToRow = $sensor->calcManhattanDistanceTo($pointOnRow);

            if ($distanceToRow > $sensorRadius) {
                continue;
            }

            $delta = $sensorRadius - $distanceToRow;

            $k = $pointOnRow->getKey();
            if (!isset($row[$k])) {
                $row[$k] = '#';
            }

            for ($i = 1; $i <= $delta; $i++) {
                $k = Position2D::key($pointOnRow->x - $i, $rowY);
                if (!isset($row[$k])) {
                    $row[$k] = '#';
                }
                $k = Position2D::key($pointOnRow->x + $i, $rowY);
                if (!isset($row[$k])) {
                    $row[$k] = '#';
                }
            }

        }

        return array_reduce($row, static function ($count, $element) {
            if ($element === '#') {
                return ++$count;
            }

            return $count;
        }, 0);

    }

}
