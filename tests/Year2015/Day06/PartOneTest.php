<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day06;

use AOC\Year2015\Day06\PartOne;
use AOC\Test\Util\SolutionTest;

/**
 * @large
 */
class PartOneTest extends SolutionTest
{
    /** @var class-string */
    public string $solutionClass = PartOne::class;

    /**
     * @return array<int, array<mixed>>
     */
    public function data(): array
    {
        return [
            [['turn on 0,0 through 999,999'], 1000000],
            [['turn off 0,0 through 999,999'], 0],
            [['input.txt'], 569999],
        ];
    }
}
