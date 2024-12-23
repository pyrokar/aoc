<?php

declare(strict_types=1);

namespace AOCTest\Year2024\Day17;

use AOC\Year2024\Day17\PartOne;
use AOCTest\Util\SolutionTestCase;
use Override;

final class PartOneTest extends SolutionTestCase
{
    /** @var class-string */
    public string $solutionClass = PartOne::class;

    /**
     * @return array<int, array<mixed>>
     */
    #[Override]
    public function data(): array
    {
        return [
            [['5,0,5,1,5,4', 10], '0,1,2'],
            [['0,1,5,4,3,0', 729], '4,6,3,5,6,3,5,2,1,0'],
            [['2,4,1,1,7,5,1,5,4,3,5,5,0,3,3,0', 38610541], '7,5,4,3,4,5,3,4,6'],
        ];
    }
}
