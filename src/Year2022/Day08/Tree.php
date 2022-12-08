<?php

namespace AOC\Year2022\Day08;

use AOC\Util\Position2D;

class Tree extends Position2D
{

    public bool $isVisible;

    public function __construct(
        public int          $x,
        public int          $y,
        readonly public int $height,
    )
    {
        parent::__construct($x, $y);
        $this->isVisible = false;
    }

}
