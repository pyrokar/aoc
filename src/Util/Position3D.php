<?php

declare(strict_types=1);

namespace AOC\Util;

class Position3D
{
    public function __construct(
        public int $x,
        public int $y,
        public int $z,
    ) {}

    /**
     * @param string $key
     * @param non-empty-string $separator
     *
     * @return self
     */
    public static function fromKey(string $key, string $separator = '|'): self
    {
        [$x, $y, $z] = explode($separator, $key);
        return new self((int) $x, (int) $y, (int) $z);
    }

    public static function key(int $x, int $y, int $z): string
    {
        return $x . '|' . $y . '|' . $z;
    }

    public function getKey(): string
    {
        return self::key($this->x, $this->y, $this->z);
    }

    public function move(Direction3D $direction, int $distance = 1): self
    {
        switch ($direction) {
            case Direction3D::Up:
                $this->z += $distance;
                break;
            case Direction3D::Down:
                $this->z -= $distance;
                break;
            case Direction3D::Forward:
                $this->y += $distance;
                break;
            case Direction3D::Backward:
                $this->y -= $distance;
                break;
            case Direction3D::Right:
                $this->x += $distance;
                break;
            case Direction3D::Left:
                $this->x -= $distance;
                break;
        }

        return $this;
    }

    public function isEqualTo(Position3D $position): bool
    {
        return $this->x === $position->x && $this->y === $position->y && $this->z === $position->z;
    }

    public function getPositionForDirection(Direction3D $direction): Position3D
    {
        return (clone $this)->move($direction, 1);
    }

}
