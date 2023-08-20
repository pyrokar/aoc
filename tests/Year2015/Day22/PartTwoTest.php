<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day22;

use AOC\Year2015\Day22\PartTwo;
use AOC\Test\Util\SolutionTest;

/**
 * @medium
 */
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
            [[51, 9, 50, 500], 1216],
        ];
    }
}
