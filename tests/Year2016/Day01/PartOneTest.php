<?php declare(strict_types=1);

namespace AOCTest\Year2016\Day01;

use AOC\Year2016\Day01\PartOne;
use AOC\Test\Util\SolutionTest;

class PartOneTest extends SolutionTest
{
    /** @var class-string */
    protected string $solutionClass = PartOne::class;

    /**
     * @return array<int, array<mixed>>
     */
    public function data(): array
    {
        return [
            [['R2, L3'], 5],
            [['R2, R2, R2'], 2],
            [['R5, L5, R5, R3'], 12],
            [['input'], 301],
        ];
    }
}
