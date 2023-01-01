<?php declare(strict_types=1);

namespace AOC\Year2022\Day24;

use AOC\Util\Position2D;
use Generator;

class PartTwo
{
    use Solution;

    /**
     * @param Generator<int, string, void, void> $input
     * @param int $maxX
     * @param int $maxY
     *
     * @return int
     */
    public function __invoke(Generator $input, int $maxX, int $maxY): int
    {
        Position2D::invertY();

        $this->maxX = $maxX;
        $this->maxY = $maxY;

        $start = new Position2D(1, 0);
        $end = $this->getEnd($input);


        $minutes = [
            $this->findMinDistance($start, $end),
            $this->findMinDistance($end, $start),
            $this->findMinDistance($start, $end)
        ];

        return array_sum($minutes);
    }
}
