<?php declare(strict_types=1);

namespace AOC\Year2016\Day03;

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
     * @throws PcreException
     *
     * @return int
     */
    public function solvePartOne(Generator $input): int
    {
        $possibleCount = 0;

        foreach ($input as $line) {
            preg_match('/(\d+)\s+(\d+)\s+(\d+)/', trim($line), $m);

            $sides = array_sort([(int) $m[1], (int) $m[2], (int) $m[3]]);

            $possibleCount += ($sides[0] + $sides[1] > $sides[2]) ? 1 : 0;
        }

        return $possibleCount;
    }

    /**
     * @param Generator<int, string, void, void> $input
     *
     * @throws PcreException
     *
     * @return int
     */
    public function solvePartTwo(Generator $input): int
    {
        $possibleCount = 0;
        $triangles = [[], [], []];

        foreach ($input as $i => $line) {
            preg_match('/(\d+)\s+(\d+)\s+(\d+)/', trim($line), $m);

            $triangles[0][] = (int) $m[1];
            $triangles[1][] = (int) $m[2];
            $triangles[2][] = (int) $m[3];

            if (($i + 1) % 3 === 0) {
                foreach ($triangles as $triangle) {
                    $sides = array_sort($triangle);
                    $possibleCount += ($sides[0] + $sides[1] > $sides[2]) ? 1 : 0;
                }
                $triangles = [[], [], []];
            }
        }

        return $possibleCount;
    }
}
