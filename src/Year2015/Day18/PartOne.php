<?php

declare(strict_types=1);

namespace AOC\Year2015\Day18;

use AOC\Util\Position2D;
use Generator;

class PartOne
{
    /**
     * @param Generator<int, string, void, void> $input
     * @param int $size
     * @param int $steps
     *
     * @return int
     */
    public function __invoke(Generator $input, int $size, int $steps): int
    {
        $lights = [];

        foreach ($input as $y => $line) {
            foreach (str_split($line) as $x => $char) {
                if ($char === '#') {
                    $lights[Position2D::key($x, $y)] = '#';
                }
            }
        }

        $nextLights = [];

        for ($step = 0; $step < $steps; ++$step) {
            for ($x = 0; $x < $size; ++$x) {
                for ($y = 0; $y < $size; ++$y) {
                    $position = new Position2D($x, $y);
                    $neighborLights = 0;

                    foreach ($position->getNeighborKeys() as $neighborKey) {
                        if (isset($lights[$neighborKey])) {
                            $neighborLights++;
                        }
                    }

                    if (isset($lights[$position->getKey()]) && ($neighborLights === 2 || $neighborLights === 3)) {
                        $nextLights[$position->getKey()] = '#';
                    }

                    if (!isset($lights[$position->getKey()]) && $neighborLights === 3) {
                        $nextLights[$position->getKey()] = '#';
                    }
                }
            }

            $lights = $nextLights;
            $nextLights = [];
        }

        return count($lights);
    }
}
