<?php

declare(strict_types=1);

namespace AOC\Year2018\Day10;

use AOC\Util\Position2D;
use AOC\Util\SpanningRectangle;
use AOC\Util\Vector2D;
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
        /** @var non-empty-list<array{Position2D, Vector2D}> $points */
        $points = [];

        foreach ($input as $line) {
            if (preg_match('/^position=<(?<px>.+),(?<py>.+)> velocity=<(?<vx>.+),(?<vy>.+)>$/', $line, $m)) {
                $points[] = [
                    new Position2D((int) $m['px'], (int) $m['py']),
                    new Vector2D((int) $m['vx'], (int) $m['vy']),
                ];
            }
        }

        $lastHeight = PHP_INT_MAX;
        $seconds = 0;

        while (true) {
            $newPositions = [];

            $spanningRectangle = new SpanningRectangle();

            /**
             * @var Position2D $point
             * @var Vector2D $velocity
             */
            foreach ($points as [$point, $velocity]) {
                $newPosition = $point->add($velocity);
                $spanningRectangle->addPoint($newPosition);
                $newPositions[] = [$newPosition, $velocity];
            }

            if ($lastHeight > $spanningRectangle->getHeight()) {
                $lastHeight = $spanningRectangle->getHeight();
            } else {
                break;
            }

            $points = $newPositions;
            $seconds++;
        }

        return $seconds;
    }
}
