<?php

namespace AOC\Util\Pathfinding;

use AOC\Util\Position2D;
use AOC\Util\PriorityQueueMin;
use DomainException;

abstract class AStar
{
    /**
     * @var PriorityQueueMin<Position2D>
     */
    private PriorityQueueMin $frontier;
    private array $cameFrom;
    private Position2D $end;
    private array $costSoFar;

    protected function setEnd(Position2D $end): void
    {
        $this->end = $end;
    }

    public function findMinDistance(Position2D $start): int
    {
        $this->frontier = new PriorityQueueMin();
        $this->cameFrom = [];
        $this->costSoFar = [];

        $this->frontier->insert($start, 0);
        $this->cameFrom[$start->getKey()] = null;
        $this->costSoFar[$start->getKey()] = 0;

        while (!$this->frontier->isEmpty()) {
            /** @var Position2D $current */
            $current = $this->frontier->extract();
            $currentKey = $current->getKey();

            if ($currentKey === $this->end->getKey()) {
                return $this->costSoFar[$currentKey];
            }

            foreach ($this->getNeighbors($current) as $next) {
                $nextKey = $next->getKey();
                $newCost = $this->costSoFar[$currentKey] + 1;

                if (!isset($this->costSoFar[$nextKey]) || $newCost < $this->costSoFar[$nextKey]) {
                    $this->costSoFar[$nextKey] = $newCost;

                    $priority = $newCost + $next->calcManhattanDistanceTo($this->end);
                    $this->frontier->insert($next, $priority);
                    $this->cameFrom[$nextKey] = $currentKey;
                }
            }

        }

        throw new DomainException('End not found');
    }

    /**
     * @param Position2D $current
     * @return array<Position2D>
     */
    abstract protected function getNeighbors(Position2D $current): array;
}
