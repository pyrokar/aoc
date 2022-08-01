<?php declare(strict_types=1);

namespace AOCTest\Year2016\Day05;

use AOC\Year2016\Day05\Solution;
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
            ['abc', '18f47a30'],
            ['uqwqemis', '1a3099aa'],
        ];
    }

    /**
     * @return array<int, array<mixed>>
     */
    public function partTwoTestInput(): array
    {
        return [
            ['abc', '05ace8e3'],
            ['uqwqemis', '694190cd'],
        ];
    }
}
