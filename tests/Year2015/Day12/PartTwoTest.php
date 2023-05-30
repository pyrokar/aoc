<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day12;

use AOC\Year2015\Day12\PartTwo;
use AOC\Test\Util\SolutionTest;

class PartTwoTest extends SolutionTest
{
    /** @var class-string */
    public string $solutionClass = PartTwo::class;

    /**
     * @return array<int, array<mixed>>
     */
    public function data(): array
    {
        return [
            [['test.json'], 11],
            [['input.json'], 68466],
        ];
    }
}
