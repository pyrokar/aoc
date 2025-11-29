<?php

declare(strict_types=1);

namespace AOC\Year2023\Day17;

use AOC\Util\Position2D;
use Generator;

trait Shared
{
    /**
     * @param Generator<int, string> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        Position2D::invertY();

        $height = 0;
        $width = 0;

        $grid = [];

        foreach ($input as $line) {
            ++$height;
            $width = strlen($line);
            $grid[] = array_map(intval(...), str_split($line));
        }

        return $this->findPath($grid, new Position2D(0, 0), new Position2D($width - 1, $height - 1));
    }

    /**
     * @param array<int, array<int, int>> $grid
     * @param Position2D $start
     * @param Position2D $end
     *
     * @return int
     */
    abstract protected function findPath(array $grid, Position2D $start, Position2D $end): int;
}
