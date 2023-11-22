<?php

declare(strict_types=1);

namespace AOC\Year2022\Day23;

class Dimension2D
{
    public function __construct(
        public int $xMin,
        public int $xMax,
        public int $yMin,
        public int $yMax,
    ) {}

    public function expand(int $x, int $y): void
    {
        if ($x < $this->xMin) {
            $this->xMin = $x;
        } elseif ($x >= $this->xMax) {
            $this->xMax = $x + 1;
        }
        if ($y < $this->yMin) {
            $this->yMin = $y;
        } elseif ($y >= $this->yMax) {
            $this->yMax = $y + 1;
        }
    }
}
