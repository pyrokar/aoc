<?php declare(strict_types=1);

namespace AOC\Util;

class Position2D
{
    use Vector2D;

    public static int $yDirection = 1; // or -1 for inverted

    public static function invertY(): void
    {
        static::$yDirection = -1;
    }

    public function __construct(
        public int $x,
        public int $y,
        public mixed $payload = null,
    ) {
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

    /**
     * @param CompassDirection $direction
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
            CompassDirection::North => array_map(static fn ($step) => new Point2D($startX, $startY + $step), $steps),
            CompassDirection::East  => array_map(static fn ($step) => new Point2D($startX + $step, $startY), $steps),
            CompassDirection::South => array_map(static fn ($step) => new Point2D($startX, $startY - $step), $steps),
            CompassDirection::West  => array_map(static fn ($step) => new Point2D($startX - $step, $startY), $steps),
        };
    }

    /**
     * @param Position2D $position
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
     * @return array<Position2D>
     */
    public function getOrthogonalNeighbors(): array
    {
        return array_map(fn (CompassDirection $dir) => $this->getPositionForDirection($dir), CompassDirection::cases());
    }

    /**
     * @return array<string>
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
     * @return array<string>
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
     * @return array<string>
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
     * @return array<string>
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
     * @return array<string>
     */
    public function getWesternNeighborKeys(): array
    {
        return [
            self::key($this->x - 1, $this->y + static::$yDirection),
            self::key($this->x - 1, $this->y),
            self::key($this->x - 1, $this->y - static::$yDirection),
        ];
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

    public function __toString(): string
    {
        return $this->getKey();
    }
}
