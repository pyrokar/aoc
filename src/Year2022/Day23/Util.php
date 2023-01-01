<?php

namespace AOC\Year2022\Day23;

use AOC\Util\CompassDirection;
use AOC\Util\Position2D;

trait Util
{

    protected function getNeighborKeysForDirection(Position2D $position, CompassDirection $direction): array
    {
        return match ($direction) {
            CompassDirection::North => $position->getNorthernNeighborKeys(),
            CompassDirection::South => $position->getSouthernNeighborKeys(),
            CompassDirection::East => $position->getEasternNeighborKeys(),
            CompassDirection::West => $position->getWesternNeighborKeys(),
        };
    }

    protected function getNextDirection(CompassDirection $direction): CompassDirection
    {
        return match ($direction) {
            CompassDirection::North => CompassDirection::South,
            CompassDirection::South => CompassDirection::West,
            CompassDirection::West => CompassDirection::East,
            CompassDirection::East => CompassDirection::North,
        };
    }
}
