<?php

namespace AOC\Year2022\Day24;

use AOC\Util\CompassDirection;
use AOC\Util\Position2D;
use Generator;

/**
 * thanks to https://www.reddit.com/r/adventofcode/comments/zuibs3/2022_day_24_part_2_hail_of_arrows/
 */
trait Solution
{
    /** @var array<string, int> $blizzardKeys */
    protected array $wallKeys;
    /** @var array<string, int> $blizzardKeys */
    protected array $blizzardKeys;
    /** @var array<Blizzard> */
    protected array $blizzards;

    protected array $positions;

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

    protected function findMinDistance(Position2D $start, Position2D $end, $currentMinute = 0): int
    {
        $newPositions = [];
        $lastPositions = [$start];

        while (true) {
            $this->calcBlizzards();
            $currentMinute++;

            // echo 'Minute ' . $currentMinute . PHP_EOL;

            foreach ($lastPositions as $lastPosition) {
                $neighbors = $this->getNeighbors($lastPosition);

                foreach ($neighbors as $neighbor) {
                    if ($neighbor->getKey() === $end->getKey()) {
                        // echo 'end found at ' . $currentMinute . PHP_EOL;
                        return $currentMinute;
                    }

                    if (!isset($newPositions[$neighbor->getKey()])) {
                        $newPositions[$neighbor->getKey()] = $neighbor;
                    }
                }
            }

            $this->positions = $newPositions;
            $lastPositions = $newPositions;
            $newPositions = [];

            // $this->printBlizzards();
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

        if (!isset($this->blizzardKeys[$current->getKey()])) {
            $neighbors[] = new Position2D($current->x, $current->y);
        }

        return $neighbors;
    }

    public function printBlizzards(): void
    {
        for ($y = 1; $y <= $this->maxY; $y++) {
            for ($x = 1; $x <= $this->maxX; $x++) {
                $key = Position2D::key($x, $y);
                if (isset($this->blizzardKeys[$key])) {
                    echo '#';
                } elseif (isset($this->positions[$key])) {
                    echo 'o';
                } else {
                    echo '.';
                }
            }

            echo PHP_EOL;
        }
        echo PHP_EOL;
    }
}
