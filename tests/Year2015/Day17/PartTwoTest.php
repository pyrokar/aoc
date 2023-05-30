<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day17;

use AOC\Year2015\Day17\PartTwo;
use AOC\Test\Util\SolutionTest;

/**
 * @small
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
            [['test.txt', 25], 3],
            [['input.txt', 150], 17],
        ];
    }
}
