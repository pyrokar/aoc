<?php

declare(strict_types=1);

namespace AOC\Year2015\Day06;

use AOC\Util\Position2D;
use Generator;

class PartTwo
{
    /**
     * @param Generator<int, string, void, void> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $grid = [];

        foreach ($input as $line) {

            if (preg_match('/(?P<cmd>[a-z ]+) (?P<x1>\d+),(?P<y1>\d+) through (?P<x2>\d+),(?P<y2>\d+)/', $line, $m)) {

                $cmd = $m['cmd'];
                $x1 = (int) $m['x1'];
                $y1 = (int) $m['y1'];
                $x2 = (int) $m['x2'];
                $y2 = (int) $m['y2'];

                switch ($cmd) {
                    case 'turn on':
                        foreach ($this->rangeKeys($x1, $y1, $x2, $y2) as $key) {
                            if (!isset($grid[$key])) {
                                $grid[$key] = 0;
                            }
                            $grid[$key]++;
                        }
                        break;
                    case 'turn off':
                        foreach ($this->rangeKeys($x1, $y1, $x2, $y2) as $key) {
                            if (!isset($grid[$key])) {
                                $grid[$key] = 0;
                            }
                            $grid[$key]--;

                            if ($grid[$key] < 0) {
                                $grid[$key] = 0;
                            }
                        }
                        break;
                    case 'toggle':
                        foreach ($this->rangeKeys($x1, $y1, $x2, $y2) as $key) {
                            if (!isset($grid[$key])) {
                                $grid[$key] = 0;
                            }
                            $grid[$key] += 2;
                        }
                        break;
                }
            }
        }

        return array_sum($grid);
    }

    private function rangeKeys(int $x1, int $y1, int $x2, int $y2): Generator
    {
        for ($y = $y1; $y <= $y2; $y++) {
            for ($x = $x1; $x <= $x2; $x++) {
                yield Position2D::key($x, $y);
            }
        }
    }
}
