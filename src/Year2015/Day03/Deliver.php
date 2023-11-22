<?php

declare(strict_types=1);

namespace AOC\Year2015\Day03;

use AOC\Util\CompassDirection;
use AOC\Util\Position2D;
use Exception;

trait Deliver
{
    /**
     * @var array<string, int>
     */
    protected array $grid = [];

    /**
     * @param Position2D $position
     * @param string $dir
     *
     * @throws Exception
     *
     * @return Position2D new Position
     */
    protected function deliver(Position2D $position, string $dir): Position2D
    {
        $position->move(match ($dir) {
            '^' => CompassDirection::North,
            '>' => CompassDirection::East,
            'v' => CompassDirection::South,
            '<' => CompassDirection::West,
            default => throw new Exception(),
        }, 1);

        $key = $position->getKey();

        if (!isset($this->grid[$key])) {
            $this->grid[$key] = 0;
        }

        ++$this->grid[$key];

        return $position;
    }
}
