<?php
declare(strict_types=1);

namespace AOCTest\Year2015\Day13;

use AOC\Year2015\Day13\PartOne;
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
            [['test.txt'], 330],
            [['input.txt'], 709],
        ];
    }
}
