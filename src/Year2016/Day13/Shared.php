<?php declare(strict_types=1);

namespace AOC\Year2016\Day13;

use AOC\Util\CompassDirection;
use AOC\Util\Position2D;
use SplQueue;
use Generator;

trait Shared
{
    private int $number;

    /**
     * @var array<string, int>
     */
    protected array $distanceMap;

    /**
     * @var SplQueue<array{0: Position2D, 1: int}> $pointsToExplore
     */
    protected SplQueue $pointsToExplore;

    /**
     * Breadth First Search
     *
     * @param Generator<void, string, void, void> $input
     */
    private function solve(Generator $input): void
    {
        $this->number = (int) trim($input->current());

        $this->distanceMap = [];

        $this->pointsToExplore = new SplQueue();

        $this->pointsToExplore->enqueue([new Position2D(1, 1), 0]);

        while (!$this->pointsToExplore->isEmpty()) {
            [$currentPoint, $distance] = $this->pointsToExplore->dequeue();
            $key = $currentPoint->getKey();
            $this->distanceMap[$key] = $distance;

            if ($this->breakCondition($currentPoint, $distance)) {
                break;
            }

            foreach ($this->getOpenNeighbors($currentPoint) as $neighbor) {
                $this->processPoint($neighbor, $distance);
            }
        }
    }

    private function isOpenSpace(Position2D $point): bool
    {
        $x = $point->x;
        $y = $point->y;

        $a = $x * $x + 3 * $x + 2 * $x * $y + $y + $y * $y + $this->number;
        return $this->countSetBits($a) % 2 === 0;
    }

    private function countSetBits(int $n): int
    {
        $count = 0;
        while ($n) {
            $n &= ($n - 1) ;
            $count++;
        }
        return $count;
    }

    /**
     * @param Position2D $point
     * @return array<Position2D>
     */
    private function getOpenNeighbors(Position2D $point): array
    {
        $positions = [];

        foreach (CompassDirection::cases() as $direction) {
            $p = $point->getPositionForDirection($direction);
            if ($p->x >= 0 && $p->y >= 0 &&
                $this->isOpenSpace($p)
            ) {
                $positions[] = $p;
            }
        }

        return $positions;
    }

    protected function breakCondition(Position2D $currentPoint, int $distance): bool
    {
        return false;
    }

    protected function processPoint(Position2D $point, int $distance): void
    {
    }
}
