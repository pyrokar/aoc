<?php

declare(strict_types=1);

namespace AOCTest\Year2016\Day19;

use AOC\Year2016\Day19\PartTwo;
use AOCTest\Util\SolutionTestCase;

class PartTwoTest extends SolutionTestCase
{
    /** @var class-string */
    public string $solutionClass = PartTwo::class;

    /**
     * @return array<int, array<mixed>>
     */
    public function data(): array
    {
        return [
            [[5], 2],
            [[3005290], 1410967],
        ];
    }
}
