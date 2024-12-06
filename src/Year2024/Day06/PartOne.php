<?php

declare(strict_types=1);

namespace AOC\Year2024\Day06;

use AOC\Util\Position2D;
use Generator;

final class PartOne
{
    use Shared;

    /**
     * @param Generator<int, string> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        Position2D::invertY();

        $this->init($input);

        [$path,] = $this->getPath($this->obstructions, $this->free);

        return count($path);
    }

}
