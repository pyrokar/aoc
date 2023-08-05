<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day20;

use AOC\Year2015\Day20\PartTwo;
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
            [['29000000'], 705600],
        ];
    }
}
