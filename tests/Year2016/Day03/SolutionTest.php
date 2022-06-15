<?php declare(strict_types=1);

namespace AOCTest\Year2016\Day03;

use AOC\Year2016\Day03\Solution;
use AOCTest\Util\TestUtil;
use PHPUnit\Framework\TestCase;

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
            ['5 10 25', 0],
            ['input', 1050],
        ];
    }

    /**
     * @return array<int, array<mixed>>
     */
    public function partTwoTestInput(): array
    {
        return [
            ['input', 1921],
        ];
    }
}
