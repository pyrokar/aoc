<?php

declare(strict_types=1);

namespace AOC\Year2018\Day06;

use AOC\Util\Position2D;
use AOC\Util\SpanningRectangle;
use Generator;
use SplQueue;

use function array_keys;
use function count;

use const PHP_INT_MAX;

final class PartOne
{
    /**
     * @var array<string, string>
     */
    private array $positionAreas;

    /**
     * @param Generator<int, string> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $areas = [];
        $finiteAreas = [];
        $this->positionAreas = [];
        $distances = [];
        /** @var SplQueue<Position2D> $frontier */
        $frontier = new SplQueue();

        $spanningRectangle = new SpanningRectangle();

        foreach ($input as $line) {
            $point = Position2D::fromKey($line, ', ');
            $key = $point->getKey();

            $distances[$key] = 0;
            $areas[$key] = [$key => 1];
            $finiteAreas[$key] = 1;
            $this->positionAreas[$key] = $key;
            $frontier->enqueue($point);

            $spanningRectangle->addPoint($point);
        }

        while (!$frontier->isEmpty()) {
            $current = $frontier->dequeue();
            $currentKey = $current->getKey();
            $currentArea = $this->positionAreas[$currentKey];
            $nextDistance = $distances[$currentKey] + 1;

            foreach ($current->getOrthogonalNeighborKeys() as $neighborKey) {
                $neighbor = Position2D::fromKey($neighborKey);

                if ($this->isVisited($neighborKey) && ($this->positionAreas[$neighborKey] === $currentArea || $this->positionAreas[$neighborKey] === '.')) {
                    continue;
                }

                if (isset($distances[$neighborKey]) && ($distances[$neighborKey] < $nextDistance || $distances[$neighborKey] === PHP_INT_MAX)) {
                    continue;
                }

                if (!$spanningRectangle->isPositionInside($neighbor)) {
                    unset($finiteAreas[$currentArea]);
                    continue;
                }

                if (isset($distances[$neighborKey]) && $distances[$neighborKey] === $nextDistance) {
                    unset($areas[$neighborKey]);
                    $distances[$neighborKey] = PHP_INT_MAX;
                    $this->positionAreas[$neighborKey] = '.';
                    continue;
                }

                $distances[$neighborKey] = $nextDistance;
                $areas[$currentArea][$neighborKey] = 1;
                $this->positionAreas[$neighborKey] = $currentArea;
                $frontier->enqueue($neighbor);
            }
        }

        $max = 0;

        foreach (array_keys($finiteAreas) as $area) {
            if (count($areas[$area]) > $max) {
                $max = count($areas[$area]);
            }
        }

        return $max;
    }

    /**
     * @param string $neighborKey
     *
     * @return bool
     */
    public function isVisited(string $neighborKey): bool
    {
        return isset($this->positionAreas[$neighborKey]);
    }
}
