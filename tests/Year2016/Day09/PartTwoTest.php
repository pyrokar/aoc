<?php declare(strict_types=1);

namespace AOCTest\Year2016\Day09;

use AOC\Year2016\Day09\PartTwo;

class PartTwoTest extends \AOC\Test\Util\SolutionTest
{
    protected string $solutionClass = PartTwo::class;

    /**
     * @inheritDoc
     */
    public function data(): array
    {
        return [
            [['(3x3)XYZ'], 9],
            [['X(8x2)(3x3)ABCY'], 20],
            [['(27x12)(20x12)(13x14)(7x10)(1x12)A'], 241920],
            [['(25x3)(3x3)ABC(2x3)XY(5x2)PQRSTX(18x9)(3x2)TWO(5x7)SEVEN'], 445],
            [['input'], 10780403063],
        ];
    }
}
