<?php

declare(strict_types=1);

namespace AOC\Util\ShortestPath;

use AOC\Util\PriorityQueueMin;
use Closure;
use DomainException;
use Stringable;

/**
 * @template TString of string | Stringable
 */
readonly class AStar
{
    /**
     * @param Closure(TString): array<TString> $getNeighbors
     * @param Closure(TString, TString): int $getDistance
     */
    public function __construct(
        private Closure $getNeighbors,
        private Closure $getDistance,
    ) {}

    /**
     * @param TString $start
     * @param TString $end
     *
     * @return int
     */
    public function findMinDistance(mixed $start, mixed $end): int
    {
        /** @var PriorityQueueMin<int, TString> $frontier */
        $frontier = new PriorityQueueMin();
        $costSoFar = [];

        $frontier->insert($start, 0);
        $costSoFar[(string) $start] = 0;

        while (!$frontier->isEmpty()) {
            $current = $frontier->extract();
            $currentKey = (string) $current;

            if ($currentKey === (string) $end) {
                return $costSoFar[$currentKey];
            }

            foreach (($this->getNeighbors)($current) as $next) {
                $nextKey = (string) $next;
                $newCost = $costSoFar[$currentKey] + 1;

                if (!isset($costSoFar[$nextKey]) || $newCost < $costSoFar[$nextKey]) {
                    $costSoFar[$nextKey] = $newCost;

                    $priority = $newCost + ($this->getDistance)($nextKey, $end);
                    $frontier->insert($nextKey, $priority);
                }
            }
        }

        throw new DomainException('End not found');
    }
}
