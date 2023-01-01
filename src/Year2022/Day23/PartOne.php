<?php declare(strict_types=1);

namespace AOC\Year2022\Day23;

use AOC\Util\CompassDirection;
use AOC\Util\Position2D;
use Generator;

class PartOne
{
    use Util;

    /**
     * @param Generator<int, string, void, void> $input
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        Position2D::invertY();

        /** @var array<int, array<string, Position2D>> $elfPositions */
        $elfPositions = [0 => []];
        $dimensions = null;

        foreach ($input as $y => $line) {
            foreach (str_split($line) as $x => $char) {
                if ($char === '#') {
                    $elfPositions[0][Position2D::key($x, $y)] = new Position2D($x, $y);

                    if (!$dimensions) {
                        $dimensions = new Dimension2D($x, $x + 1, $y, $y + 1);
                    } else {
                        $dimensions->expand($x, $y);
                    }
                }
            }
        }

        $rounds = 10;
        $direction = CompassDirection::North;

        for ($round = 1; $round <= $rounds; $round++) {
            $newPositions = [];
            $lastElfPositions = $elfPositions[$round - 1];

            foreach ($lastElfPositions as $elfPosition) {
                $neighborElves = array_filter($elfPosition->getNeighborKeys(), static fn (string $neighborKey) => isset($lastElfPositions[$neighborKey]));

                if (empty($neighborElves)) {
                    $newPositions[$elfPosition->getKey()] = [$elfPosition];
                    continue;
                }

                $elfDirection = $direction;

                $elfMoved = false;

                for ($i = 0; $i < 4; $i++) {
                    $adjacentElves = array_filter($this->getNeighborKeysForDirection($elfPosition, $elfDirection), static fn (string $neighborKey) => isset($lastElfPositions[$neighborKey]));

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
                }
            }

            $elfPositions[$round] = [];

            foreach ($newPositions as $newPositionKey => $oldPositionArray) {
                if (count($oldPositionArray) === 1) {
                    $newPosition = Position2D::fromKey($newPositionKey);
                    $dimensions->expand($newPosition->x, $newPosition->y);
                    $elfPositions[$round][$newPositionKey] = $newPosition;
                } else {
                    foreach ($oldPositionArray as $oldPosition) {
                        $elfPositions[$round][$oldPosition->getKey()] = $oldPosition;
                    }
                }
            }

            $direction = $this->getNextDirection($direction);
        }

        $emptyTiles = 0;

        for ($y = $dimensions->yMin; $y < $dimensions->yMax; $y++) {
            for ($x = $dimensions->xMin; $x < $dimensions->xMax; $x++) {
                $key = Position2D::key($x, $y);
                if (!isset($elfPositions[$rounds][$key])) {
                    $emptyTiles++;
                }
            }
        }

        return $emptyTiles;
    }

}
