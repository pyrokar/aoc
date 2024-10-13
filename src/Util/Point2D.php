<?php

declare(strict_types=1);

namespace AOC\Util;

class Point2D
{
    use TwoDimensional;

    public function __construct(
        readonly public int $x,
        readonly public int $y,
    ) {}
}
