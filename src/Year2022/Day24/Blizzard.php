<?php

namespace AOC\Year2022\Day24;

use AOC\Util\CompassDirection;
use AOC\Util\Position2D;

class Blizzard extends Position2D
{
    public function __construct(
        int                              $x,
        int                              $y,
        public readonly CompassDirection $direction
    )
    {
        parent::__construct($x, $y);
    }

    public function getMovedBlizzard(int $mX, int $mY): self
    {
        $newPosition = $this->getPositionForDirection($this->direction);

        $newX = $newPosition->x > $mX ? 1 : ($newPosition->x < 1 ? $mX : $newPosition->x);
        $newY = $newPosition->y > $mY ? 1 : ($newPosition->y < 1 ? $mY : $newPosition->y);

        return new self($newX, $newY, $this->direction);
    }
}
