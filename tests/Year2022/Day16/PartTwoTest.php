<?php

declare(strict_types=1);

namespace AOCTest\Year2022\Day16;

use AOC\Year2022\Day16\PartTwo;
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
            [['test.txt'], 1707],
            [['input.txt'], 2752],
        ];
    }
}
