<?php declare(strict_types=1);

namespace AOCTest\Year2022\Day12;

use AOC\Year2022\Day12\PartTwo;
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
            [['test'], 29],
            [['input'], 465],
        ];
    }
}
