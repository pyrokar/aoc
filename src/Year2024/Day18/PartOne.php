<?php

declare(strict_types=1);

namespace AOC\Year2024\Day18;

use AOC\Util\Position2D;
use Generator;

final class PartOne
{
    use Shared;

    /**
     * @param Generator<int, string> $input
     * @param int $width
     * @param int $height
     * @param int $count
     *
     * @return int
     */
    public function __invoke(Generator $input, int $width, int $height, int $count): int
    {
        $pathAlgorithm = $this->init($width, $height);

        foreach ($input as $i => $line) {
            if ($i === $count) {
                break;
            }

            [$x, $y] = array_map('intval', explode(',', $line));
            $this->map[Position2D::key($x, $y)] = '#';
        }

        return $pathAlgorithm->findMinDistance(Position2D::key(0, 0), Position2D::key($width - 1, $height - 1));
    }
}
