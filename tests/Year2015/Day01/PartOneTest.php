<?php
declare(strict_types=1);

namespace AOCTest\Year2015\Day01;

use AOC\Year2015\Day01\PartOne;
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
            [['(())'], 0],
            [['()()'], 0],
            [['((('], 3],
            [['(()(()('], 3],
            [['))((((('], 3],
            [['())'], -1],
            [['))('], -1],
            [[')))'], -3],
            [[')())())'], -3],
            [['input.txt'], 232],
        ];
    }
}
