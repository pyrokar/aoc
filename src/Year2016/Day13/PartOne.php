<?php

declare(strict_types=1);

namespace AOC\Year2016\Day13;

use AOC\Util\Position2D;
use Generator;

class PartOne
{
    use Shared;

    private string $targetKey;

    /**
     * @param Generator<void, string, void, void> $input
     * @param int $x
     * @param int $y
     *
     * @return int
     */
    public function __invoke(Generator $input, int $x, int $y): int
    {
        $this->targetKey = Position2D::key($x, $y);

        $this->solve($input);

        return $this->distanceMap[$this->targetKey];
    }

    protected function breakCondition(Position2D $currentPoint, int $distance): bool
    {
        return $this->targetKey === $currentPoint->getKey();
    }

    protected function processPoint(Position2D $point, int $distance): void
    {
        $key = $point->getKey();

        if (!isset($this->distanceMap[$key])) {
            $this->distanceMap[$key] = $distance;
            $this->pointsToExplore->enqueue([$point, $distance + 1]);
        }
    }
}
