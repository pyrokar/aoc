<?php
declare(strict_types=1);

namespace AOCTest\Year2022\Day20;

use AOC\Year2022\Day20\PartOne;
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
            [['test.txt'], 3],
            [['input.txt'], 13967],
        ];
    }
}
