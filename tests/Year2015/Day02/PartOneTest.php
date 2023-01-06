<?php
declare(strict_types=1);

namespace AOCTest\Year2015\Day02;

use AOC\Year2015\Day02\PartOne;
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
            [['2x3x4'], 58],
            [['1x1x10'], 43],
            [['input.txt'], 1586300],
        ];
    }
}
