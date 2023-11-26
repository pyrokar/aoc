<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day10;

use AOCTest\Util\SolutionTest;
use AOC\Year2015\Day10\PartOne;

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
            [['1', 1], 2],
            [['11', 1], 2],
            [['21', 1], 4],
            [['1211', 1], 6],
            [['111221', 1], 6],
            [['1', 5], 6],

            [['3113322113', 40], 329356],
        ];
    }
}
