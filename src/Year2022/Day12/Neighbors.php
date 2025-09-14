<?php

declare(strict_types=1);

namespace AOC\Year2022\Day12;

use AOC\Util\Position2D;

trait Neighbors
{
    /** @var array<string, int> */
    private array $heightMap;

    protected function getNeighbors(Position2D $current): array
    {
        $currentKey = $current->getKey();
        $currentHeight = $this->heightMap[$currentKey];

        return array_filter($current->getOrthogonalNeighbors(), function (Position2D $neighbor) use ($currentHeight): bool {
            $neighborKey = $neighbor->getKey();
            return (isset($this->heightMap[$neighborKey]) && $this->heightMap[$neighborKey] - $currentHeight <= 1);
        });
    }
}
