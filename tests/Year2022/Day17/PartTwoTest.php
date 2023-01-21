<?php
declare(strict_types=1);

namespace AOCTest\Year2022\Day17;

use AOC\Year2022\Day17\PartTwo;
use AOC\Test\Util\SolutionTest;

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
            [['test.txt'], 1514285714288],
            //[['input.txt'], 0],
        ];
    }
}
