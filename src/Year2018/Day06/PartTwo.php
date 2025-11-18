<?php

declare(strict_types=1);

namespace AOC\Year2018\Day06;

use AOC\Util\Position2D;
use AOC\Util\SpanningRectangle;
use Generator;

use function abs;
use function array_fill;

final class PartTwo
{
    /**
     * @param Generator<int, string> $input
     * @param int $maximum
     *
     * @return int
     */
    public function __invoke(Generator $input, int $maximum): int
    {
        $coordinates = [];
        $sr = new SpanningRectangle();

        foreach ($input as $line) {
            $point = Position2D::fromKey($line, ', ');

            $coordinates[] = $point;

            $sr->addPoint($point);
        }

        $horizontalDistances = array_fill($sr->point0->x, $sr->getWidth(), 0);
        $verticalDistances = array_fill($sr->point0->y, $sr->getHeight(), 0);

        foreach ($coordinates as $coordinate) {
            foreach ($horizontalDistances as $ix => &$d) {
                $d += abs($coordinate->x - $ix);
            }

            unset($d);

            foreach ($verticalDistances as $iy => &$d) {
                $d += abs($coordinate->y - $iy);
            }

            unset($d);
        }

        $size = 0;

        foreach ($sr->allPoints() as $point) {
            $sum = $horizontalDistances[$point->x] + $verticalDistances[$point->y];
            if ($sum < $maximum) {
                $size++;
            }
        }

        return $size;
    }

}
