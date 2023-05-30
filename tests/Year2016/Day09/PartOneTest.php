<?php

declare(strict_types=1);

namespace AOCTest\Year2016\Day09;

use AOC\Year2016\Day09\PartOne;

class PartOneTest extends \AOC\Test\Util\SolutionTest
{
    protected string $solutionClass = PartOne::class;

    /**
     * @inheritDoc
     */
    public function data(): array
    {
        return [
            [['ADVENT'], 6],
            [['A(1x5)BC'], 7],
            [['(3x3)XYZ'], 9],
            [['A(2x2)BCD(2x2)EFG'], 11],
            [['(6x1)(1x3)A'], 6],
            [['X(8x2)(3x3)ABCY'], 18],
            [['input'], 102239],
        ];
    }
}
