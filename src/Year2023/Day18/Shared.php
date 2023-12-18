<?php

declare(strict_types=1);

namespace AOC\Year2023\Day18;

use Generator;
use Safe\Exceptions\PcreException;

use function Safe\preg_match;

trait Shared
{
    /**
     * @param Generator<int, string> $input
     *
     * @throws PcreException
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        static $mapDir = ['U' => [0, -1], 'R' => [1, 0], 'D' => [0, 1], 'L' => [-1, 0]];

        $sum = 0;

        $horizontalLines = [];
        $verticalLines = [];

        $currentX = 0;
        $currentY = 0;

        $prevDir = '';

        foreach ($input as $line) {
            if (!preg_match('/(?<dir>\w) (?<dist>\d+) \(#(?<color>[0-9a-f]{6})\)/', $line, $m)) {
                continue;
            }

            [$distance, $dir] = $this->extract($m);

            $nextX = $currentX + $mapDir[$dir][0] * $distance;
            $nextY = $currentY + $mapDir[$dir][1] * $distance;

            if ($dir === 'U' || $dir === 'D') {
                $verticalLines[$currentX][] = $currentY;
                $verticalLines[$currentX][] = $nextY;
                sort($verticalLines[$currentX]);

            } else {
                $horizontalLines[$currentY][] = $currentX;
                $horizontalLines[$currentY][] = $nextX;
                sort($horizontalLines[$currentY]);
            }

            if ($dir === 'L') {
                if ($prevDir === 'D') {
                    $sum += $distance;
                } else {
                    $sum += $distance - 1;
                }

            }

            if ($dir === 'U' && $prevDir === 'L') {
                $sum += 1;
            }

            $currentX = $nextX;
            $currentY = $nextY;
            $prevDir = $dir;
        }

        ksort($horizontalLines);
        ksort($verticalLines);

        $segmentsX = count($verticalLines);
        $segmentsY = count($horizontalLines) - 1;

        $yLines = array_keys($horizontalLines);
        $xLines = array_keys($verticalLines);

        for ($yS = 0; $yS < $segmentsY; ++$yS) {

            $y = $yLines[$yS];
            $height = $yLines[$yS + 1] - $y;

            $startX = 0;
            $isIn = false;

            for ($xS = 0; $xS < $segmentsX; ++$xS) {
                $x = $xLines[$xS];
                $yRanges = $verticalLines[$x];

                if ($this->isVerticalLine($y, $yRanges)) {
                    if ($isIn) {
                        $isIn = false;

                        $width = $x - $startX;
                        $area = ($width + 1) * $height;
                        $sum += $area;

                    } else {
                        $isIn = true;
                        $startX = $x;
                    }
                }
            }
        }

        return $sum;
    }

    /**
     * @param int $y
     * @param list<int> $yRanges
     *
     * @return bool
     */
    private function isVerticalLine(int $y, array $yRanges): bool
    {
        for ($i = 0, $l = count($yRanges); $i < $l; $i += 2) {
            if ($y >= $yRanges[$i] && $y < $yRanges[$i + 1]) {
                return true;
            }
        }

        return false;
    }
}
