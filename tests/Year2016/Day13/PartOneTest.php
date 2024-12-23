<?php

declare(strict_types=1);

namespace AOCTest\Year2016\Day13;

use AOC\Year2016\Day13\PartOne;
use AOCTest\Util\SolutionTestCase;
use Override;

class PartOneTest extends SolutionTestCase
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
            [['10', 7, 4], 11],
            [['1350', 31, 39], 92],
        ];
    }
}
