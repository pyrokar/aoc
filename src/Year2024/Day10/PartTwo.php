<?php

declare(strict_types=1);

namespace AOC\Year2024\Day10;

use AOC\Util\Position2D;
use Generator;

use function array_sum;

final class PartTwo
{
    use Shared;

    /**
     * @param Generator<int, string> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $this->init($input);

        foreach ($this->map[0] as $posKey => $_) {
            $this->hike($posKey, 0);
        }

        return array_sum($this->map[0]);
    }

    private function hike(string $posKey, int $height): int
    {
        if ($this->map[$height][$posKey] > -1) {
            return $this->map[$height][$posKey];
        }

        $nextHeight = $height + 1;

        $pos = Position2D::fromKey($posKey);

        $score = 0;

        foreach ($pos->getOrthogonalNeighborKeys() as $neighborKey) {
            if (!isset($this->map[$nextHeight][$neighborKey])) {
                continue;
            }
            $score += $this->hike($neighborKey, $nextHeight);
        }

        $this->map[$height][$posKey] = $score;
        return $score;
    }
}
