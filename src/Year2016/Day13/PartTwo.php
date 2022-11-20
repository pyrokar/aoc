<?php declare(strict_types=1);

namespace AOC\Year2016\Day13;

use AOC\Util\Position2D;
use Generator;

class PartTwo
{
    use Shared;

    private int $count = 1;

    /**
     * @param Generator<void, string, void, void> $input
     * @return int
     */
    public function __invoke(Generator $input): int
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
