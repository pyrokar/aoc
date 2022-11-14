<?php declare(strict_types=1);

namespace AOCTest\Year2016\Day04;

use AOC\Year2016\Day04\PartOne;
use AOC\Test\Util\SolutionTest;

class PartOneTest extends SolutionTest
{
    /** @var class-string */
    public string $solutionClass = PartOne::class;

    /**
     * @return array<int, array<mixed>>
     */
    public function data(): array
    {
        return [
            [['aaaaa-bbb-z-y-x-123[abxyz]'], 123],
            [['a-b-c-d-e-f-g-h-987[abcde]'], 987],
            [['not-a-real-room-404[oarel]'], 404],
            [['totally-real-room-200[decoy]'], 0],
            [['input'], 361724],
        ];
    }
}
