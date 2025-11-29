<?php

declare(strict_types=1);

namespace AOC\Year2022\Day15;

use AOC\Util\Position2D;
use Generator;

use function Safe\preg_match;

class PartTwo
{
    /**
     * @param Generator<void, string, void, void> $input
     * @param int $max
     *
     * @return int
     */
    public function __invoke(Generator $input, int $max): int
    {
        /** @var array<int, array<Range2D>> $rows */
        $rows = [];

        foreach ($input as $line) {

            if (!preg_match('/Sensor at x=(?<sx>-?\d+), y=(?<sy>-?\d+): closest beacon is at x=(?<bx>-?\d+), y=(?<by>-?\d+)/', $line, $m)) {
                continue;
            }

            $sensor = new Position2D((int) $m['sx'], (int) $m['sy']);

            $beacon = new Position2D((int) $m['bx'], (int) $m['by']);

            $sensorRadius = $sensor->calcManhattanDistanceTo($beacon);

            for ($dx = 0, $y = $sensor->y - $sensorRadius; $y <= $sensor->y + $sensorRadius; $y++) {

                if ($y < 0 || $y > $max) {

                    if ($y < $sensor->y) {
                        $dx++;
                    } else {
                        $dx--;
                    }

                    continue;
                }

                $newRange = new Range2D($sensor->x - $dx, $sensor->x + $dx);

                if (!isset($rows[$y])) {
                    $rows[$y] = [];
                }

                foreach ($rows[$y] as $i => $range) {

                    if ($newRange->canMerge($range)) {
                        $newRange->merge($range);
                        unset($rows[$y][$i]);
                    }
                }

                $rows[$y] = array_values($rows[$y]);
                $rows[$y][] = $newRange;

                if ($y < $sensor->y) {
                    $dx++;
                } else {
                    $dx--;
                }

            }

        }

        foreach ($rows as $y => $row) {
            if (count($row) === 2) {
                if ($row[0]->end < $row[1]->start) {
                    return ($row[0]->end + 1) * 4000000 + $y;
                }

                return ($row[1]->end + 1) * 4000000 + $y;
            }
        }

        return 1;
    }
}
