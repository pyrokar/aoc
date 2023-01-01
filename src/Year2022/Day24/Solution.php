<?php

namespace AOC\Year2022\Day24;

use AOC\Util\CompassDirection;
use AOC\Util\Position2D;
use Generator;

trait Solution
{
    /** @var array<string, int> $blizzardKeys */
    protected array $wallKeys;
    /** @var array<string, int> $blizzardKeys */
    protected array $blizzardKeys;
    /** @var array<Blizzard> */
    protected array $blizzards;

    protected int $maxX;
    protected int $maxY;

    /**
     * @param Generator<int, string, void, void> $input
     * @return Position2D
     */
    protected function getEnd(Generator $input): Position2D
    {
        $this->blizzards = [];
        $this->blizzardKeys = [];
        $this->wallKeys = [];

        foreach ($input as $y => $line) {
            foreach (str_split($line) as $x => $char) {
                if ($y === $this->maxY + 1 && $char === '.') {
                    $end = new Position2D($x, $y);
                }

                if ($char === '.') {
                    continue;
                }

                if ($char === '#') {
                    $this->wallKeys[Position2D::key($x, $y)] = 1;
                    continue;
                }

                $newBlizzard = match ($char) {
                    '>' => new Blizzard($x, $y, CompassDirection::East),
                    '<' => new Blizzard($x, $y, CompassDirection::West),
                    '^' => new Blizzard($x, $y, CompassDirection::North),
                    'v' => new Blizzard($x, $y, CompassDirection::South)
                };

                $this->blizzards[] = $newBlizzard;
                $this->blizzardKeys[$newBlizzard->getKey()] = 1;
            }
        }
        return $end;
    }

    /**
     */
    protected function calcBlizzards(): void
    {
        $newBlizzards = [];
        $newBlizzardKeys = [];

        foreach ($this->blizzards as $lastBlizzard) {
            $newBlizzard = $lastBlizzard->getMovedBlizzard($this->maxX, $this->maxY);
            $newBlizzards[] = $newBlizzard;
            $newBlizzardKeys[$newBlizzard->getKey()] = 1;
        }

        $this->blizzards = $newBlizzards;
        $this->blizzardKeys = $newBlizzardKeys;
    }

    protected function findMinDistance(Position2D $start, Position2D $end): int
    {
        $currentMinute = 0;
        $newPositions = [];
        $lastPositions = [$start];

        while (true) {
            $this->calcBlizzards();
            $currentMinute++;

            foreach ($lastPositions as $lastPosition) {
                $neighbors = $this->getNeighbors($lastPosition);

                foreach ($neighbors as $neighbor) {
                    if ($neighbor->getKey() === $end->getKey()) {
                        return $currentMinute;
                    }

                    if (!isset($newPositions[$neighbor->getKey()])) {
                        $newPositions[$neighbor->getKey()] = $neighbor;
                    }
                }
            }

            $lastPositions = $newPositions;
            $newPositions = [];
        }
    }

    /**
     * @param Position2D $current
     * @return array<Position2D>
     */
    protected function getNeighbors(Position2D $current): array
    {
        $neighbors = [];

        foreach ($current->getOrthogonalNeighbors() as $neighbor) {
            $neighborKey = $neighbor->getKey();

            if ($neighbor->x < 0 | $neighbor->y < 0 | $neighbor->x > $this->maxX + 2 | $neighbor->y > $this->maxY + 2) {
                continue;
            }

            if (isset($this->wallKeys[$neighborKey])) {
                continue;
            }

            if (isset($this->blizzardKeys[$neighborKey])) {
                continue;
            }

            $neighbors[] = $neighbor;
        }

        if (empty($neighbors)) {
            $neighbors[] = new Position2D($current->x, $current->y);
        }

        return $neighbors;
    }
}
