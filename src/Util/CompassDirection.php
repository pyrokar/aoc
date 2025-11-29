<?php

declare(strict_types=1);

namespace AOC\Util;

enum CompassDirection: string
{
    case North = 'n';

    case East = 'e';

    case South = 's';

    case West = 'w';

    public function turnLeft(): CompassDirection
    {
        return match ($this) {
            self::North => self::West,
            self::East => self::North,
            self::South => self::East,
            self::West => self::South,
        };
    }

    public function turnCCW(): CompassDirection
    {
        return $this->turnLeft();
    }

    public function turnRight(): CompassDirection
    {
        return match ($this) {
            self::North => self::East,
            self::East => self::South,
            self::South => self::West,
            self::West => self::North,
        };
    }

    public function turnCW(): CompassDirection
    {
        return $this->turnRight();
    }

    public function isOpposite(self $direction): bool
    {
        return match ($this) {
            self::North => $direction === self::South,
            self::East => $direction === self::West,
            self::South => $direction === self::North,
            self::West => $direction === self::East,
        };
    }
}
