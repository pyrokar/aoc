<?php

declare(strict_types=1);

namespace AOC\Util;

use Override;
use Stringable;

class Position2D implements Stringable
{
    use TwoDimensional;

    public static int $yDirection = 1; // or -1 for inverted

    public function __construct(
        public int $x,
        public int $y,
    ) {}

    #[Override]
    public function __toString(): string
    {
        return $this->getKey();
    }

    /**
     * normal: north = y++
     * inverted : north = y--
     *
     * @return void
     */
    public static function invertY(): void
    {
        static::$yDirection = -1;
    }

    public static function fromKey(string $key): self
    {
        [$x, $y] = explode('|', $key);
        return new self((int) $x, (int) $y);
    }

    /**
     * @mutable
     *
     * @param CompassDirection $direction
     * @param int $distance
     *
     * @return Position2D
     */
    public function move(CompassDirection $direction, int $distance): self
    {
        switch ($direction) {
            case CompassDirection::North:
                $this->y += $distance * static::$yDirection;
                break;
            case CompassDirection::East:
                $this->x += $distance;
                break;
            case CompassDirection::South:
                $this->y -= $distance * static::$yDirection;
                break;
            case CompassDirection::West:
                $this->x -= $distance;
                break;
        }

        return $this;
    }

    public function moveHexagonal(HexagonalDirection $direction): void
    {
        [$this->x, $this->y] = $this->applyDifferentials(HexagonalDirection::getDifferentials($direction));
    }

    /**
     * @param CompassDirection $direction
     *
     * @return Position2D
     */
    public function getPositionForDirection(CompassDirection $direction): Position2D
    {
        return (clone $this)->move($direction, 1);
    }

    /**
     * @param CompassDirection $direction
     * @param int $distance
     *
     * @return array<Point2D>
     */
    public function walk(CompassDirection $direction, int $distance): array
    {
        $steps = range(1, $distance);
        $startX = $this->x;
        $startY = $this->y;

        $this->move($direction, $distance);

        return match ($direction) {
            CompassDirection::North => array_map(static fn(int $step): Point2D => new Point2D($startX, $startY + $step), $steps),
            CompassDirection::East  => array_map(static fn(int $step): Point2D => new Point2D($startX + $step, $startY), $steps),
            CompassDirection::South => array_map(static fn(int $step): Point2D => new Point2D($startX, $startY - $step), $steps),
            CompassDirection::West  => array_map(static fn(int $step): Point2D => new Point2D($startX - $step, $startY), $steps),
        };
    }

    /**
     * @param Position2D $position
     *
     * @return Point2D[]
     */
    public function walkTo(Position2D $position): array
    {
        $dir = $this->getOrthogonalDirectionTo($position);
        $distance = $this->calcManhattanDistanceTo($position);

        if (!$dir) {
            return [];
        }

        return $this->walk($dir, $distance);
    }

    /**
     * @return non-empty-array<string, Position2D>
     */
    public function getOrthogonalNeighbors(): array
    {
        return array_reduce(CompassDirection::cases(), function (array $arr, CompassDirection $dir) {
            $arr[$dir->value] = $this->getPositionForDirection($dir);
            return $arr;
        }, []);
    }

    /**
     * @return non-empty-list<string>
     */
    public function getOrthogonalNeighborKeys(): array
    {
        return [
            self::key($this->x - 1, $this->y),
            self::key($this->x, $this->y - static::$yDirection),
            self::key($this->x, $this->y + static::$yDirection),
            self::key($this->x + 1, $this->y),
        ];
    }

    /**
     * @return array{string, string}
     */
    public function getVerticalNeighborKeys(): array
    {
        return [
            $this->getPositionForDirection(CompassDirection::North)->getKey(),
            $this->getPositionForDirection(CompassDirection::South)->getKey(),
        ];
    }

    /**
     * @return array{string, string}
     */
    public function getHorizontalNeighborKeys(): array
    {
        return [
            $this->getPositionForDirection(CompassDirection::West)->getKey(),
            $this->getPositionForDirection(CompassDirection::East)->getKey(),
        ];
    }

    /**
     * @return non-empty-list<string>
     */
    public function getNeighborKeys(): array
    {
        return [
            self::key($this->x - 1, $this->y - static::$yDirection),
            self::key($this->x - 1, $this->y),
            self::key($this->x - 1, $this->y + static::$yDirection),
            self::key($this->x, $this->y - static::$yDirection),
            self::key($this->x, $this->y + static::$yDirection),
            self::key($this->x + 1, $this->y - static::$yDirection),
            self::key($this->x + 1, $this->y),
            self::key($this->x + 1, $this->y + static::$yDirection),
        ];
    }

    /**
     * @return non-empty-list<string>
     */
    public function getNorthernNeighborKeys(): array
    {
        return [
            self::key($this->x - 1, $this->y + static::$yDirection),
            self::key($this->x, $this->y + static::$yDirection),
            self::key($this->x + 1, $this->y + static::$yDirection),
        ];
    }

    /**
     * @return non-empty-list<string>
     */
    public function getEasternNeighborKeys(): array
    {
        return [
            self::key($this->x + 1, $this->y + static::$yDirection),
            self::key($this->x + 1, $this->y),
            self::key($this->x + 1, $this->y - static::$yDirection),
        ];
    }

    /**
     * @return non-empty-list<string>
     */
    public function getSouthernNeighborKeys(): array
    {
        return [
            self::key($this->x - 1, $this->y - static::$yDirection),
            self::key($this->x, $this->y - static::$yDirection),
            self::key($this->x + 1, $this->y - static::$yDirection),
        ];
    }

    /**
     * @return non-empty-list<string>
     */
    public function getWesternNeighborKeys(): array
    {
        return [
            self::key($this->x - 1, $this->y + static::$yDirection),
            self::key($this->x - 1, $this->y),
            self::key($this->x - 1, $this->y - static::$yDirection),
        ];
    }

    /**
     * @return non-empty-list<string>
     */
    public function getHexagonalNeighborKeys(): array
    {
        return array_map(fn(HexagonalDirection $direction): string => $this->getHexagonalNeighborKeyForDirection($direction), HexagonalDirection::cases());
    }

    /**
     * @param HexagonalDirection $direction
     *
     * @return string
     */
    public function getHexagonalNeighborKeyForDirection(HexagonalDirection $direction): string
    {
        return self::key(...$this->applyDifferentials(HexagonalDirection::getDifferentials($direction)));
    }

    public function getHexagonalNeighborForDirection(HexagonalDirection $direction): Position2D
    {
        return new self(...$this->applyDifferentials(HexagonalDirection::getDifferentials($direction)));
    }

    public function getOrthogonalDirectionTo(Position2D $position): ?CompassDirection
    {
        if ($this->x > $position->x) {
            return CompassDirection::West;
        }

        if ($this->x < $position->x) {
            return CompassDirection::East;
        }

        if ($this->y > $position->y) {
            return CompassDirection::South;
        }

        if ($this->y < $position->y) {
            return CompassDirection::North;
        }

        return null;
    }

    /**
     * @param Position2D $position
     *
     * @return bool
     */
    public function isDiagonalFrom(Position2D $position): bool
    {
        return ($this->x !== $position->x && $this->y !== $position->y);
    }

    public function isOrthogonalFrom(Position2D $position2D): bool
    {
        return ($this->x === $position2D->x || $this->y === $position2D->y);
    }

    /**
     * @param array{int, int} $differentials
     *
     * @return array{int, int}
     */
    private function applyDifferentials(array $differentials): array
    {
        return [$this->x + $differentials[0], $this->y + $differentials[1] * static::$yDirection];
    }
}
