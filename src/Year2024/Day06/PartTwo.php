<?php

declare(strict_types=1);

namespace AOC\Year2024\Day06;

use AOC\Util\Position2D;
use Generator;

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
        Position2D::invertY();

        $this->init($input);

        [$path,] = $this->getPath($this->obstructions, $this->free);

        $loops = 0;

        foreach ($path as $key => $directions) {
            if ($key === $this->startPosition->getKey()) {
                continue;
            }

            $obstruction = $this->obstructions;
            $obstruction[$key] = 1;

            $free = $this->free;
            unset($free[$key]);

            [, $hasLoop] = $this->getPath($obstruction, $free);

            if ($hasLoop) {
                $loops++;
            }
        }

        return $loops;
    }
}
