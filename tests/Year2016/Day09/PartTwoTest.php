<?php

declare(strict_types=1);

namespace AOCTest\Year2016\Day09;

use AOC\Year2016\Day09\PartTwo;

class PartTwoTest extends \AOCTest\Util\SolutionTestCase
{
    protected string $solutionClass = PartTwo::class;

    /**
     * @inheritDoc
     */
    public function data(): array
    {
        return [
            [[$this->generatorFromString('(3x3)XYZ')], 9],
            [[$this->generatorFromString('X(8x2)(3x3)ABCY')], 20],
            [[$this->generatorFromString('(27x12)(20x12)(13x14)(7x10)(1x12)A')], 241920],
            [[$this->generatorFromString('(25x3)(3x3)ABC(2x3)XY(5x2)PQRSTX(18x9)(3x2)TWO(5x7)SEVEN')], 445],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 10780403063],
        ];
    }
}
