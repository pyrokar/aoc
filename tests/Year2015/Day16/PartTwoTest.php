<?php
declare(strict_types=1);

namespace AOCTest\Year2015\Day16;

use AOC\Year2015\Day16\PartTwo;
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
            [['input.txt'], 405],
        ];
    }
}
