<?php declare(strict_types=1);

namespace AOCTest\Year2016\Day04;

use AOC\Year2016\Day04\Solution;
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
            ['aaaaa-bbb-z-y-x-123[abxyz]', 123],
            ['a-b-c-d-e-f-g-h-987[abcde]', 987],
            ['not-a-real-room-404[oarel]', 404],
            ['totally-real-room-200[decoy]', 0],
            ['input', 361724],
        ];
    }

    /**
     * @return array<int, array<mixed>>
     */
    public function partTwoTestInput(): array
    {
        return [
            ['input', 482],
        ];
    }
}
