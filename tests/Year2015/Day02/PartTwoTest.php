<?php
declare(strict_types=1);

namespace AOCTest\Year2015\Day02;

use AOC\Year2015\Day02\PartTwo;
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
            [['2x3x4'], 34],
            [['1x1x10'], 14],
            [['input.txt'], 3737498],
        ];
    }
}
