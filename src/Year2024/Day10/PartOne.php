<?php

declare(strict_types=1);

namespace AOC\Year2024\Day10;

use AOC\Util\Position2D;
use Generator;

final class PartOne
{
    use Shared;

    /** @var array<string, array<string, int>> */
    private array $reachableNines;

    /**
     * @param Generator<int, string> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $this->reachableNines = [];

        $this->init($input);

        $score = 0;

        foreach ($this->map[0] as $posKey => $_) {
            $this->hike($posKey, 0);

            $score += count($this->reachableNines[$posKey]);
        }

        return $score;
    }

    /**
     * @param string $posKey
     * @param int $height
     *
     * @return array<string, int>
     */
    private function hike(string $posKey, int $height): array
    {
        if ($height === 9) {
            return [$posKey => 1];
        }

        if (isset($this->reachableNines[$posKey])) {
            return $this->reachableNines[$posKey];
        }

        $nextHeight = $height + 1;

        $pos = Position2D::fromKey($posKey);

        $reachableNines = [];

        foreach ($pos->getOrthogonalNeighborKeys() as $neighborKey) {
            if (!isset($this->map[$nextHeight][$neighborKey])) {
                continue;
            }

            $reachableNines = [...$reachableNines, ...$this->hike($neighborKey, $nextHeight)];
        }

        $this->reachableNines[$posKey] = $reachableNines;

        return $reachableNines;
    }

}
