<?php

declare(strict_types=1);

namespace AOC\Year2018\Day13;

use AOC\Util\CompassDirection;
use AOC\Util\Position2D;

final class Cart
{
    private int $intersectionCounter = 0;

    public function __construct(public Position2D $position, public CompassDirection $direction) {}

    /**
     * @param array<string, string> $tracks
     *
     * @return void
     */
    public function move(array $tracks): void
    {
        $this->position->move($this->direction, 1);

        if (!isset($tracks[$this->position->getKey()])) {
            $a = 0;
        }

        $currentTrack = $tracks[$this->position->getKey()];

        switch ($currentTrack) {
            case '/':
                $this->direction = match ($this->direction) {
                    CompassDirection::North, CompassDirection::South => $this->direction->turnRight(),
                    CompassDirection::East, CompassDirection::West => $this->direction->turnLeft(),
                };
                break;
            case '\\':
                $this->direction = match ($this->direction) {
                    CompassDirection::North, CompassDirection::South => $this->direction->turnLeft(),
                    CompassDirection::East, CompassDirection::West => $this->direction->turnRight(),
                };
                break;
            case '+':
                $this->direction = match ($this->intersectionCounter) {
                    0 => $this->direction->turnLeft(),
                    2 => $this->direction->turnRight(),
                    default => $this->direction,
                };
                $this->intersectionCounter = ($this->intersectionCounter + 1) % 3;
                break;
        }
    }
}
