<?php

declare(strict_types=1);

namespace AOC\Util;

class SpanningRectangle
{
    public function __construct(
        public int $x,
        public int $y,
        public int $width = 1,
        public int $height = 1,
    ) {}

    public function growX(int $x): self
    {
        if ($x < $this->x) {
            $this->width += $this->x - $x;
            $this->x = $x;
        } elseif ($this->x + $this->width - 1 < $x) {
            $this->width = $x - $this->x;
        }

        return $this;
    }

    public function growY(int $y): self
    {
        if ($y < $this->y) {
            $this->height += $this->y - $y;
            $this->y = $y;
        } elseif ($this->y + $this->height - 1 < $y) {
            $this->height = $y - $this->y;
        }

        return $this;
    }

}
