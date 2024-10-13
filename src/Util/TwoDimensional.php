<?php

declare(strict_types=1);

namespace AOC\Util;

trait TwoDimensional
{
    public static function key(int $x, int $y): string
    {
        return $x . '|' . $y;
    }

    public function getKey(): string
    {
        return self::key($this->x, $this->y);
    }

    public function calcManhattanDistanceTo(self $point): int
    {
        return (int) abs($this->x - $point->x) + abs($this->y - $point->y);
    }

    public function toVector(): Vector2D
    {
        return new Vector2D($this->x, $this->y);
    }
}
