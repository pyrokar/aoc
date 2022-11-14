<?php declare(strict_types=1);

namespace AOCTest\Year2016\Day06;

use AOC\Year2016\Day06\Solution;
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
            ['test', 'easter'],
            ['input', 'ygjzvzib'],
        ];
    }

    /**
     * @return array<int, array<mixed>>
     */
    public function partTwoTestInput(): array
    {
        return [
            ['test', 'advent'],
            ['input', 'pdesmnoz'],
        ];
    }
}
