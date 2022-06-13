<?php declare(strict_types=1);

namespace AOC\Util;

trait Vector2D
{
    public static function key(int $x, int $y): string
    {
        return '(' . $x . '|' . $y . ')';
    }

    public function getKey(): string
    {
        return self::key($this->x, $this->y);
    }

    public function calcManhattanDistanceTo(Point2D $point): int
    {
        return (int) abs($this->x - $point->x) + abs($this->y - $point->y);
    }
}
