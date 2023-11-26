<?php

declare(strict_types=1);

namespace AOCTest\Year2016\Day14;

use AOC\Year2016\Day14\PartTwo;
use AOCTest\Util\SolutionTest;

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
            [['abc'], 22551],
            [['ngcjuoqr'], 20092],
        ];
    }
}
