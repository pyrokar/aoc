<?php

declare(strict_types=1);

namespace AOCTest\Year2016\Day13;

use AOC\Year2016\Day13\PartTwo;
use AOCTest\Util\SolutionTestCase;

class PartTwoTest extends SolutionTestCase
{
    /** @var class-string */
    public string $solutionClass = PartTwo::class;

    /**
     * @return array<int, array<mixed>>
     */
    #[\Override]
    public function data(): array
    {
        return [
            [['1350'], 124],
        ];
    }
}
