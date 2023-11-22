<?php

declare(strict_types=1);

namespace AOC\Year2022\Day17;

use AOC\Util\Position2D;

class RockShape
{
    /**
     * @param array<Position2D> $rockPositions
     * @param int $width
     * @param int $height
     */
    public function __construct(
        private readonly array $rockPositions,
        public readonly int    $width,
        public readonly int    $height,
    ) {}

    /**
     * @param Position2D $position
     *
     * @return array<string, int>
     */
    public function getPositionKeys(Position2D $position): array
    {
        return array_flip(array_map(fn($rockPosition) => $this->addPositions($position, $rockPosition)->getKey(), $this->rockPositions));
    }

    /**
     * @param Position2D $pos1
     * @param Position2D $pos2
     *
     * @return Position2D
     */
    private function addPositions(Position2D $pos1, Position2D $pos2): Position2D
    {
        return new Position2D($pos1->x + $pos2->x, $pos1->y - $pos2->y);
    }
}
