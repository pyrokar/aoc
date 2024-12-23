<?php

declare(strict_types=1);

namespace AOC\Year2023\Day17;

use AOC\Util\CompassDirection;
use AOC\Util\Position2D;
use AOC\Util\PriorityQueueMin;
use Override;

class PartTwo
{
    use Shared;

    /**
     * @param array<int, array<int, int>> $grid
     * @param Position2D $start
     * @param Position2D $end
     *
     * @return int
     */
    #[Override]
    protected function findPath(array $grid, Position2D $start, Position2D $end): int
    {
        /** @var PriorityQueueMin<int, array{Position2D, string, int, array<string, int>}> $frontier */
        $frontier = new PriorityQueueMin();
        $costSoFar = [];

        $frontier->insert([$start, 'e', 0, [$start->getKey() => 0]], 0);
        $costSoFar[$start->getKey()] = ['e_0' => 0, 's_0' => 0];

        $endCost = PHP_INT_MAX;
        $endKey = $end->getKey();

        while (!$frontier->isEmpty()) {
            [$current, $dir, $dirSteps, $path] = $frontier->extract();
            $currentKey = $current->getKey();

            $currentDirKey = $dir . '_' . $dirSteps;

            if ($currentKey === $endKey) {
                $endCost = min($endCost, ...array_values($costSoFar[$currentKey]));
                continue;
            }

            $neighborChanged = false;

            foreach (CompassDirection::cases() as $direction) {
                $next = $current->getPositionForDirection($direction);

                if (!isset($grid[$next->y][$next->x]) || isset($path[$next->getKey()])) {
                    continue;
                }

                // so funktioniert das noch nicht
                if ($direction->value === $dir && $dirSteps > 9) {
                    continue;
                }

                if ($direction->value !== $dir && $dirSteps < 4) {
                    continue;
                }

                $nextKey = $next->getKey();
                $nextDirSteps = ($direction->value === $dir) ? $dirSteps + 1 : 1;
                $nextCostKey = $direction->value . '_' . $nextDirSteps;

                $newCost = $costSoFar[$currentKey][$currentDirKey] + $grid[$next->y][$next->x];

                if ($newCost > $endCost) {
                    continue;
                }

                if (!isset($costSoFar[$nextKey][$nextCostKey]) || $newCost < $costSoFar[$nextKey][$nextCostKey]) {

                    if ($nextKey === $endKey && ($nextDirSteps < 4 || $nextDirSteps > 9)) {
                        continue;
                    }

                    $costSoFar[$nextKey][$nextCostKey] = $newCost;

                    $priority = $newCost + $next->calcManhattanDistanceTo($end);
                    $frontier->insert([$next, $direction->value, ($direction->value === $dir) ? $dirSteps + 1 : 1, [...$path, $next->getKey() => $grid[$next->y][$next->x]]], $priority);
                    $neighborChanged = true;
                }
            }

            if ($neighborChanged) {
                $frontier->insert([$current, $dir, $dirSteps, $path], 1);
            }
        }

        return $endCost;
    }
}
