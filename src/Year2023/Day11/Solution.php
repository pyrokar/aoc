<?php

declare(strict_types=1);

namespace AOC\Year2023\Day11;

use AOC\Util\Position2D;
use Generator;

class Solution
{
    /**
     * @param Generator<int, string> $input
     * @param int $expansions
     *
     * @return int
     */
    public function __invoke(Generator $input, int $expansions = 1): int
    {
        $width = 0;
        $height = 0;

        $galaxies = [];
        $galaxiesXY = [];
        $galaxiesYX = [];
        $freeRows = [];
        $freeColumns = [];

        foreach ($input as $y => $line) {
            $height++;
            $width = strlen($line);
            foreach (str_split($line) as $x => $char) {
                if ($char === '#') {
                    $galaxiesXY[$x][$y] = 1;
                    $galaxiesYX[$y][$x] = 1;
                    $galaxies[] = Position2D::key($x, $y);

                    if (isset($freeColumns[$x])) {
                        unset($freeColumns[$x]);
                    }

                    if (isset($freeRows[$y])) {
                        unset($freeRows[$y]);
                    }
                } elseif ($char === '.') {
                    if (!isset($galaxiesXY[$x])) {
                        $freeColumns[$x] = 1;
                    }
                    if (!isset($galaxiesYX[$y])) {
                        $freeRows[$y] = 1;
                    }
                }
            }
        }

        $galaxiesInCluster = [];

        for ($x = 0, $cx = 0; $x < $width; ++$x) {
            if (isset($freeColumns[$x])) {
                ++$cx;
                continue;
            }

            foreach ($galaxiesXY[$x] as $y => $galaxy) {
                $galaxiesInCluster[Position2D::key($x, $y)] = [$cx];
            }
        }

        for ($y = 0, $cy = 0; $y < $height; ++$y) {
            if (isset($freeRows[$y])) {
                ++$cy;
                continue;
            }

            foreach ($galaxiesYX[$y] as $x => $galaxy) {
                $galaxiesInCluster[Position2D::key($x, $y)][] = $cy;
            }
        }

        $distances = [];

        foreach ($galaxies as $i => $key1) {
            $position = Position2D::fromKey($key1);

            foreach ($galaxies as $j => $key2) {
                $distance = $position->calcManhattanDistanceTo(Position2D::fromKey($key2));

                $cluster1 = $galaxiesInCluster[$key1];
                $cluster2 = $galaxiesInCluster[$key2];
                $distance += $expansions * (abs($cluster1[0] - $cluster2[0]) + abs($cluster1[1] - $cluster2[1]));

                $distances[($i + 1) . '-' . ($j + 1)] = $distance;
            }
        }

        return array_sum($distances) / 2;
    }
}
