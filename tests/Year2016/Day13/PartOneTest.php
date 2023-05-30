<?php

declare(strict_types=1);

namespace AOCTest\Year2016\Day13;

use AOC\Year2016\Day13\PartOne;
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
            [['10', 7, 4], 11],
            [['1350', 31, 39], 92],
        ];
    }
}
