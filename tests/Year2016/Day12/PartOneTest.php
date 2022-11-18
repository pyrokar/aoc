<?php declare(strict_types=1);

namespace AOCTest\Year2016\Day12;

use AOC\Year2016\Day12\PartOne;
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
            [['test'], 42],
            [['input'], 318007],
        ];
    }
}
