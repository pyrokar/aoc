<?php

declare(strict_types=1);

namespace AOC\Util;

enum HexagonalDirection
{
    case NorthWest;

    case NorthEast;

    case East;

    case SouthEast;

    case SouthWest;

    case West;

    /**
     * @param HexagonalDirection $direction
     *
     * @return array{int, int} [dx, dy]
     */
    public static function getDifferentials(self $direction): array
    {
        return match ($direction) {
            self::East => [1, 0],
            self::West => [-1, 0],
            self::NorthEast => [0, 1],
            self::NorthWest => [-1, 1],
            self::SouthEast => [1, -1],
            self::SouthWest => [0, -1],
        };
    }
}
