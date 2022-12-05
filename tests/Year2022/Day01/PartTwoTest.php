<?php declare(strict_types=1);

namespace AOCTest\Year2022\Day01;

use AOC\Year2022\Day01\PartTwo;
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
            [['test'], 45000],
            [['input'], 206289],
        ];
    }
}
