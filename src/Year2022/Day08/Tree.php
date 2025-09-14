<?php

declare(strict_types=1);

namespace AOC\Year2022\Day08;

use AOC\Util\Position2D;

class Tree extends Position2D
{
    public bool $isVisible = false;

    public function __construct(
        int          $x,
        int          $y,
        public readonly int $height,
    ) {
        parent::__construct($x, $y);
    }
}
