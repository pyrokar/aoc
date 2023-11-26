<?php

declare(strict_types=1);

namespace AOCTest\Year2016\Day13;

use AOC\Year2016\Day13\PartTwo;
use AOCTest\Util\SolutionTest;

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
            [['1350'], 124],
        ];
    }
}
