<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day21;

use AOC\Year2015\Day21\PartTwo;
use AOCTest\Util\SolutionTest;

class PartTwoTest extends SolutionTest
{
    /** @var class-string */
    public string $solutionClass = PartTwo::class;

    /**
     * @return array<int, array<mixed>>
     */
    public function data(): array
    {
        return [
            [[103, 9, 2, 100], 201],
        ];
    }
}
