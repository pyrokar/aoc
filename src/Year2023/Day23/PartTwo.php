<?php

declare(strict_types=1);

namespace AOC\Year2023\Day23;

use AOC\Util\Position2D;
use Override;

class PartTwo
{
    use Shared;

    #[Override]
    protected function addPosition(int $x, int $y, string $char): void
    {
        $this->grid[Position2D::key($x, $y)] = '.';
    }
}
