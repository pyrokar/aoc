<?php

declare(strict_types=1);

namespace AOC\Util\Pathfinding;

use AOC\Util\Position2D;
use AOC\Util\PriorityQueueMin;
use DomainException;

abstract class AStar
{
    private Position2D $end;

    protected function setEnd(Position2D $end): void
    {
        $this->end = $end;
    }

    public function findMinDistance(Position2D $start): int
    {
        $frontier = new PriorityQueueMin();
        $costSoFar = [];

        $frontier->insert($start, 0);
        $costSoFar[$start->getKey()] = 0;

        while (!$frontier->isEmpty()) {
            /** @var Position2D $current */
            $current = $frontier->extract();
            $currentKey = $current->getKey();

            if ($currentKey === $this->end->getKey()) {
                return $costSoFar[$currentKey];
            }

            foreach ($this->getNeighbors($current) as $next) {
                $nextKey = $next->getKey();
                $newCost = $costSoFar[$currentKey] + 1;

                if (!isset($costSoFar[$nextKey]) || $newCost < $costSoFar[$nextKey]) {
                    $costSoFar[$nextKey] = $newCost;

                    $priority = $newCost + $next->calcManhattanDistanceTo($this->end);
                    $frontier->insert($next, $priority);
                }
            }

        }

        throw new DomainException('End not found');
    }

    /**
     * @param Position2D $current
     *
     * @return array<Position2D>
     */
    abstract protected function getNeighbors(Position2D $current): array;
}
