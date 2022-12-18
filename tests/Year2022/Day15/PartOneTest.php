<?php declare(strict_types=1);

namespace AOCTest\Year2022\Day15;

use AOC\Year2022\Day15\PartOne;
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
            [['test', 10], 26],
            [['input', 2000000], 4919281],
        ];
    }
}
