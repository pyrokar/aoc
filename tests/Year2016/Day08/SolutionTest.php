<?php declare(strict_types=1);

namespace AOCTest\Year2016\Day08;

use AOC\Year2016\Day08\Solution;
use AOC\Test\Util\TestUtil;
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
            ['test', 6],
            ['input', 121],
        ];
    }

    /**
     * @return array<int, array<mixed>>
     */
    public function partTwoTestInput(): array
    {
        return [
            ['test', 6],
            ['input', 121],
        ];
    }
}
