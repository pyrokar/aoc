<?php

declare(strict_types=1);

namespace AOCTest\Year2016\Day14;

use AOC\Year2016\Day14\PartOne;
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
            [['abc'], 22728],
            [['ngcjuoqr'], 18626],
        ];
    }
}
