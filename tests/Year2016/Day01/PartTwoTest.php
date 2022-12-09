<?php declare(strict_types=1);

namespace AOCTest\Year2016\Day01;

use AOC\Year2016\Day01\PartTwo;
use AOC\Test\Util\SolutionTest;

class PartTwoTest extends SolutionTest
{
    /** @var class-string */
    protected string $solutionClass = PartTwo::class;

    /**
     * @return array<int, array<mixed>>
     */
    public function data(): array
    {
        return [
            [['R8, R4, R4, R8'], 4],
            [['input'], 130],
        ];
    }
}