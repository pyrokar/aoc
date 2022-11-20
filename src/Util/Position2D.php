<?php declare(strict_types=1);

namespace AOC\Util;

class Position2D
{
    use Vector2D;

    public function __construct(
        public int $x,
        public int $y,
    ) {
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
                $this->y += $distance;
                break;
            case CompassDirection::East:
                $this->x += $distance;
                break;
            case CompassDirection::South:
                $this->y -= $distance;
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
}
