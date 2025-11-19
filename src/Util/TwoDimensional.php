<?php

declare(strict_types=1);

namespace AOC\Util;

trait TwoDimensional
{
    /**
     * @param string $key
     * @param non-empty-string $separator
     *
     * @return self
     */
    public static function fromKey(string $key, string $separator = '|'): self
    {
        [$x, $y] = explode($separator, $key);
        return new self((int) $x, (int) $y);
    }

    /**
     * @param int $x
     * @param int $y
     * @param non-empty-string $separator
     *
     * @return string
     */
    public static function key(int $x, int $y, string $separator = '|'): string
    {
        return $x . $separator . $y;
    }

    /**
     * @param non-empty-string $separator
     *
     * @return string
     */
    public function getKey(string $separator = '|'): string
    {
        return self::key($this->x, $this->y, $separator);
    }

    public function calcManhattanDistanceTo(self $point): int
    {
        return (int) abs($this->x - $point->x) + abs($this->y - $point->y);
    }

    public function toVector(): Vector2D
    {
        return new Vector2D($this->x, $this->y);
    }

    public function add(Vector2D $vector): self
    {
        return new self($this->x + $vector->x, $this->y + $vector->y);
    }
}
