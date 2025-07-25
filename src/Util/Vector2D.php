<?php

declare(strict_types=1);

namespace AOC\Util;

class Vector2D
{
    use TwoDimensional;

    public function __construct(
        public readonly int $x,
        public readonly int $y,
    ) {}

    public static function fromPoint(Point2D $point): self
    {
        return new self($point->x, $point->y);
    }

    public function mul(int $k): self
    {
        return new self($this->x * $k, $this->y * $k);
    }

    public function add(self $vector): self
    {
        return new self($this->x + $vector->x, $this->y + $vector->y);
    }

    public function toPoint(): Point2D
    {
        return new Point2D($this->x, $this->y);
    }

}
