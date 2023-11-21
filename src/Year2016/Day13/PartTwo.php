<?php

declare(strict_types=1);

namespace AOC\Year2016\Day13;

use AOC\Util\Position2D;

class PartTwo
{
    use Shared;

    private int $count = 1;

    /**
     * @param string $input
     *
     * @return int
     */
    public function __invoke(string $input): int
    {
        $this->solve($input);

        return $this->count;
    }

    protected function breakCondition(Position2D $currentPoint, int $distance): bool
    {
        return $distance >= 50;
    }

    protected function processPoint(Position2D $point, int $distance): void
    {
        $key = $point->getKey();

        if (!isset($this->distanceMap[$key])) {
            $this->distanceMap[$key] = $distance;
            $this->pointsToExplore->enqueue([$point, $distance + 1]);

            $this->count++;
        }
    }
}
