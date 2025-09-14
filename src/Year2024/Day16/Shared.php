<?php

declare(strict_types=1);

namespace AOC\Year2024\Day16;

use AOC\Util\CompassDirection;
use AOC\Util\Position2D;
use AOC\Util\PriorityQueueMin;
use DomainException;
use Generator;

trait Shared
{
    /** @var array<string, array<string>>  */
    protected array $predecessors;

    /**
     * @var array<string, string>
     */
    protected array $grid;

    protected PositionDir $start;

    protected Position2D $end;

    protected function getDistance(Position2D $position, Position2D $end): int
    {
        return $position->calcManhattanDistanceTo($end);
    }

    /**
     * @param Generator $input
     *
     * @return void
     */
    protected function init(Generator $input): void
    {
        Position2D::invertY();

        $start = null;
        $end = null;

        $this->grid = [];

        foreach ($input as $y => $line) {
            foreach (str_split((string) $line) as $x => $char) {
                if ($char === '#') {
                    continue;
                }

                $this->grid[Position2D::key($x, $y)] = $char;

                if ($char === 'S') {
                    $start = new PositionDir($x, $y, CompassDirection::East);
                }

                if ($char === 'E') {
                    $end = new Position2D($x, $y);
                }
            }
        }

        if (!$start || !$end) {
            throw new DomainException('No source or target found!');
        }

        $this->start = $start;
        $this->end = $end;
    }

    protected function shortestPath(): int
    {
        $startKey = $this->start->getKey();
        $endKey = $this->end->getKey();

        $this->predecessors = [$startKey => []];

        /** @var PriorityQueueMin<int, PositionDir> $frontier */
        $frontier = new PriorityQueueMin();
        $costSoFar = [];

        $frontier->insert($this->start, 0);
        $costSoFar[$startKey] = 0;

        while (!$frontier->isEmpty()) {
            $current = $frontier->extract();
            $currentKey = $current->getKey();

            if ($currentKey === $endKey) {
                return $costSoFar[$currentKey];
            }

            foreach ($this->getNeighbors($current) as [$next, $nextCost]) {
                $nextKey = $next->getKey();
                $newCost = $costSoFar[$currentKey] + $nextCost;
                $this->predecessors[$nextKey][] = $currentKey;

                if (!isset($costSoFar[$nextKey]) || $newCost < $costSoFar[$nextKey]) {
                    $costSoFar[$nextKey] = $newCost;

                    $priority = $newCost + $this->getDistance($next, $this->end);
                    $frontier->insert($next, $priority);

                }
            }
        }

        throw new DomainException('End not found');
    }

    /**
     * @param PositionDir $currentPos
     *
     * @return array<array{PositionDir, int}>
     */
    protected function getNeighbors(PositionDir $currentPos): array
    {
        $neighbors = [];

        foreach (CompassDirection::cases() as $direction) {
            $nextPos = PositionDir::fromPosition2D($currentPos->getPositionForDirection($direction), $direction);

            if (!isset($this->grid[$nextPos->getKey()])) {
                continue;
            }

            if ($direction->isOpposite($currentPos->dir)) {
                continue;
            }

            if ($direction === $currentPos->dir) {
                $neighbors[] = [$nextPos, 1];
            } else {
                $neighbors[] = [$nextPos, 1001];
            }
        }

        return $neighbors;
    }
}
