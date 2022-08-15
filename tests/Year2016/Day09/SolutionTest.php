<?php declare(strict_types=1);

namespace AOCTest\Year2016\Day09;

use AOC\Year2016\Day09\Solution;
use AOCTest\Util\TestUtil;
use PHPUnit\Framework\TestCase;

/**
 * @large
 */
class SolutionTest extends TestCase
{
    use TestUtil;

    /** @var class-string */
    public static string $solutionClass = Solution::class;

    /**
     * @return array<int, array<mixed>>
     */
    public function partOneTestInput(): array
    {
        return [
            ['ADVENT', 6],
            ['A(1x5)BC', 7],
            ['(3x3)XYZ', 9],
            ['A(2x2)BCD(2x2)EFG', 11],
            ['(6x1)(1x3)A', 6],
            ['X(8x2)(3x3)ABCY', 18],
            ['input', 102239],
        ];
    }

    /**
     * @return array<int, array<mixed>>
     */
    public function partTwoTestInput(): array
    {
        return [
            ['(3x3)XYZ', 9],
            ['X(8x2)(3x3)ABCY', 20],
            ['(27x12)(20x12)(13x14)(7x10)(1x12)A', 241920],
            ['(25x3)(3x3)ABC(2x3)XY(5x2)PQRSTX(18x9)(3x2)TWO(5x7)SEVEN', 445],
            ['input', 10780403063],
        ];
    }
}
