<?php

declare(strict_types=1);

namespace AOC\Year2023\Day23;

use AOC\Util\Position2D;

class PartOne
{
    use Shared;

    protected function addPosition(int $x, int $y, string $char): void
    {
        $this->grid[Position2D::key($x, $y)] = $char;
    }
}
