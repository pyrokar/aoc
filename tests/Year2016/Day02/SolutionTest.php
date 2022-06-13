<?php declare(strict_types=1);

namespace AOCTest\Year2016\Day02;

use AOC\Year2016\Day02\Solution;
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
            ['test', '1985'],
            ['input', '24862'],
        ];
    }

    /**
     * @return array<int, array<mixed>>
     */
    public function partTwoTestInput(): array
    {
        return [
            ['test', '5DB3'],
            ['input', '46C91'],
        ];
    }
}
