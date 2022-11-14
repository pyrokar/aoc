<?php declare(strict_types=1);

namespace AOCTest\Year2016\Day10;

use AOC\Year2016\Day10\PartTwo;
use AOC\Test\Util\SolutionTest;

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
            [['test'], 30],
            [['input'], 1085],
        ];
    }
}
