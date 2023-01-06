<?php
declare(strict_types=1);

namespace AOCTest\Year${Year}\Day${Day};

use AOC\Year${Year}\Day${Day}\PartOne;
use AOC\Test\Util\SolutionTest;

class PartOneTest extends SolutionTest
{
    /** @var class-string */
    public string ${DS}solutionClass = PartOne::class;

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