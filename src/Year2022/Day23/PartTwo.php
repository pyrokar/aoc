<?php

declare(strict_types=1);

namespace AOC\Year2022\Day23;

use AOC\Util\CompassDirection;
use AOC\Util\Position2D;
use Generator;

class PartTwo
{
    use Util;

    /**
     * @param Generator<int, string> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        Position2D::invertY();

        /** @var array<string, Position2D> $lastElfPositions */
        $lastElfPositions = [];
        $dimensions = new Dimension2D(0, 0, 0, 0);

        foreach ($input as $y => $line) {
            foreach (str_split($line) as $x => $char) {
                if ($char === '#') {
                    $lastElfPositions[Position2D::key($x, $y)] = new Position2D($x, $y);

                    $dimensions->expand($x, $y);
                }
            }
        }

        $direction = CompassDirection::North;

        $round = 1;

        do {
            $elvesMoved = false;

            $newPositions = [];

            foreach ($lastElfPositions as $elfPosition) {
                $neighborElves = array_filter($elfPosition->getNeighborKeys(), static fn(string $neighborKey) => isset($lastElfPositions[$neighborKey]));

                if (empty($neighborElves)) {
                    $newPositions[$elfPosition->getKey()] = [$elfPosition];
                    continue;
                }

                $elfDirection = $direction;

                $elfMoved = false;

                for ($i = 0; $i < 4; $i++) {
                    $adjacentElves = array_filter($this->getNeighborKeysForDirection($elfPosition, $elfDirection), static fn(string $neighborKey) => isset($lastElfPositions[$neighborKey]));

                    if (empty($adjacentElves)) {
                        $newPosition = $elfPosition->getPositionForDirection($elfDirection);
                        $newPositionKey = $newPosition->getKey();
                        if (!isset($newPositions[$newPositionKey])) {
                            $newPositions[$newPositionKey] = [];
                        }
                        $newPositions[$newPositionKey][] = $elfPosition;
                        $elfMoved = true;
                        break;
                    }

                    $elfDirection = $this->getNextDirection($elfDirection);
                }

                if (!$elfMoved) {
                    $newPositions[$elfPosition->getKey()] = [$elfPosition];
                } else {
                    $elvesMoved = true;
                }
            }

            $lastElfPositions = [];

            foreach ($newPositions as $newPositionKey => $oldPositionArray) {
                if (count($oldPositionArray) === 1) {
                    $newPosition = Position2D::fromKey($newPositionKey);
                    $dimensions->expand($newPosition->x, $newPosition->y);
                    $lastElfPositions[$newPositionKey] = $newPosition;
                } else {
                    foreach ($oldPositionArray as $oldPosition) {
                        $lastElfPositions[$oldPosition->getKey()] = $oldPosition;
                    }
                }
            }

            $direction = $this->getNextDirection($direction);
            $round++;
        } while ($elvesMoved);

        return $round - 1;
    }
}
