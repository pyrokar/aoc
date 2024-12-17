<?php

declare(strict_types=1);

namespace AOC\Year2024\Day16;

use AOC\Util\CompassDirection;
use AOC\Util\Position2D;

class PositionDir extends Position2D
{
    public function __construct(int $x, int $y, public CompassDirection $dir)
    {
        parent::__construct($x, $y);
    }

    public static function fromPosition2D(Position2D $position2D, CompassDirection $dir): self
    {
        return new self($position2D->x, $position2D->y, $dir);
    }

}
