<?php

declare(strict_types=1);

namespace AOC\Year2018\Day10;

use AOC\Util\SpanningRectangle;
use Generator;

use Safe\Exceptions\PcreException;

use function Safe\preg_match;

use const PHP_INT_MAX;

/**
 * @phpstan-type Point array{int, int, int, int}
 */
final class Solution
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
        /** @var non-empty-list<Point> $points */
        $points = [];

        foreach ($input as $line) {
            if (preg_match('/^position=<(?<px>.+),(?<py>.+)> velocity=<(?<vx>.+),(?<vy>.+)>$/', $line, $m)) {
                $points[] = [(int) $m['px'], (int) $m['py'], (int) $m['vx'], (int) $m['vy']];
            }
        }

        $lastHeight = PHP_INT_MAX;
        $seconds = 0;

        while (true) {
            $newPositions = [];

            $spanningRectangle = null;

            foreach ($points as $point) {
                $newX = $point[0] + $point[2];
                $newY = $point[1] + $point[3];
                $newPositions[] = [$newX, $newY, $point[2], $point[3]];

                if (!$spanningRectangle) {
                    $spanningRectangle = new SpanningRectangle($newX, $newY);
                }

                $spanningRectangle->growX($newX);
                $spanningRectangle->growY($newY);
            }

            if ($lastHeight > $spanningRectangle->height) {
                $lastHeight = $spanningRectangle->height;
            } else {
                break;
            }

            $points = $newPositions;
            $seconds++;
        }

        return $seconds;
    }
}
