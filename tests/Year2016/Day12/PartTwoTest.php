<?php declare(strict_types=1);

namespace AOCTest\Year2016\Day12;

use AOC\Test\Util\SolutionTest;
use AOC\Year2016\Day12\PartTwo;

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
            [['input'], 9227661],
        ];
    }
}
