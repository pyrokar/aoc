<?php
declare(strict_types=1);

namespace AOCTest\Year${Year}\Day${Day};

use AOC\Year${Year}\Day${Day}\PartTwo;
use AOC\Test\Util\SolutionTest;

class PartTwoTest extends SolutionTest
{
    /** @var class-string */
    public string ${DS}solutionClass = PartTwo::class;

    /**
     * @return array<int, array<mixed>>
     */
    public function data(): array
    {
        return [
            [['test.txt'], 0],
            [['input.txt'], 0],
        ];
    }
}