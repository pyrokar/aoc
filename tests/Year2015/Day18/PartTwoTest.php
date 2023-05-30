<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day18;

use AOC\Year2015\Day18\PartTwo;
use AOC\Test\Util\SolutionTest;

/**
 * @large
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
            [['test.txt', 6, 5], 17],
            [['input.txt', 100, 100], 924],
        ];
    }
}
