<?php declare(strict_types=1);

namespace AOCTest\Year2016\Day07;

use AOC\Year2016\Day07\Solution;
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
            ['test_part1', 2],
            ['input', 118],
        ];
    }

    /**
     * @return array<int, array<mixed>>
     */
    public function partTwoTestInput(): array
    {
        return [
            ['test_part2', 3],
            ['input', 260],
        ];
    }
}
