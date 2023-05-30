<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day17;

use AOC\Year2015\Day17\PartOne;
use AOC\Test\Util\SolutionTest;

/**
 * @medium
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
            [['test.txt', 25], 4],
            [['input.txt', 150], 1638],
        ];
    }
}
