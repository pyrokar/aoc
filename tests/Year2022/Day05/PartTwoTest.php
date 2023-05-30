<?php

declare(strict_types=1);

namespace AOCTest\Year2022\Day05;

use AOC\Year2022\Day05\PartTwo;
use AOC\Test\Util\SolutionTest;

/**
 * @large
 */
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
            [['test', [
                ['Z', 'N'],
                ['M', 'C', 'D'],
                ['P']
            ]], 'MCD'],
            [['input', [
                ['T', 'P', 'Z', 'C', 'S', 'L', 'Q', 'N'],
                ['L', 'P', 'T', 'V', 'H', 'C', 'G'],
                ['D', 'C', 'Z', 'F'],
                ['G', 'W', 'T', 'D', 'L', 'M', 'V', 'C'],
                ['P', 'W', 'C'],
                ['P', 'F', 'J', 'D', 'C', 'T', 'S', 'Z'],
                ['V', 'W', 'G', 'B', 'D'],
                ['N', 'J', 'S', 'Q', 'H', 'W'],
                ['R', 'C', 'Q', 'F', 'S', 'L', 'V']
            ]], 'DCVTCVPCL'],
        ];
    }
}
