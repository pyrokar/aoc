<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day05;

use AOC\Year2015\Day05\PartTwo;
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
            [['qjhvhtzxzqqjkmpb'], 1],
            [['xxyxx'], 1],
            [['uurcxstgmygtbstg'], 0],
            [['ieodomkazucvgmuy'], 0],
            [['input.txt'], 55],
        ];
    }
}
