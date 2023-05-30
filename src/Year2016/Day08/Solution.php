<?php

declare(strict_types=1);

namespace AOC\Year2016\Day08;

use AOC\Util\Display2D;
use Generator;

use Safe\Exceptions\PcreException;

use function Safe\preg_match;

class Solution
{
    /**
     * @param Generator<void, string, void, void> $input
     * @param int $width
     * @param int $height
     *
     * @throws PcreException
     *
     * @return int
     *
     */
    public function __invoke(Generator $input, int $width, int $height): int
    {
        $display = new Display2D($width, $height);

        foreach ($input as $line) {
            $line = trim($line);
            if (preg_match('/rect (?<width>\d+)x(?<height>\d+)/', $line, $matches)) {
                for ($x = 0; $x < (int) $matches['width']; ++$x) {
                    for ($y = 0; $y < (int) $matches['height']; ++$y) {
                        $display->set($x, $y);
                    }
                }
            }

            if (preg_match('/rotate column x=(?<x>\d+) by (?<by>\d+)/', $line, $matches)) {
                $display->rotateColumn((int) $matches['x'], (int) $matches['by']);
            }

            if (preg_match('/rotate row y=(?<y>\d+) by (?<by>\d+)/', $line, $matches)) {
                $display->rotateRow((int) $matches['y'], (int) $matches['by']);
            }
        }

        echo $display;

        return $display->countPixels();
    }
}
