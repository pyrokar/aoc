<?php
declare(strict_types=1);

namespace AOCTest\Year2022\Day20;

use AOC\Year2022\Day20\PartTwo;
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
            [['test.txt'], 1623178306],
            [['input.txt'], 1790365671518],
        ];
    }
}