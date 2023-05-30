<?php

declare(strict_types=1);

namespace AOCTest\Year2022\Day08;

use AOC\Year2022\Day08\PartOne;
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
            [['test', 5], 21],
            [['input', 99], 1647],
        ];
    }
}
