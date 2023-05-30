<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day06;

use AOC\Year2015\Day06\PartTwo;
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
            [['turn on 0,0 through 0,0'], 1],
            [['toggle 0,0 through 999,999'], 2000000],
            [['input.txt'], 17836115],
        ];
    }
}
