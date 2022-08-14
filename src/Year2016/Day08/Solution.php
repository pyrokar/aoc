<?php declare(strict_types=1);

namespace AOC\Year2016\Day08;

use AOC\Util\Display2D;
use AOC\Util\SolutionInterface;
use AOC\Util\SolutionUtil;
use Generator;

use Safe\Exceptions\PcreException;

use function Safe\preg_match;

class Solution implements SolutionInterface
{
    use SolutionUtil;

    /**
     * @param Generator<void, string, void, void> $input
     *
     * @return int
     *
     * @throws PcreException
     */
    public function solvePartOne(Generator $input): int
    {
        preg_match('/screen (?<width>\d+) (?<height>\d+)/', $input->current(), $screenSize);

        $display = new Display2D((int) $screenSize['width'], (int) $screenSize['height']);

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

    /**
     * @param Generator<void, string, void, void> $input
     *
     * @return int
     *
     * @throws PcreException
     */
    public function solvePartTwo(Generator $input): int
    {
        return $this->solvePartOne($input);
    }
}
