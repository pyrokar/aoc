<?php

declare(strict_types=1);

namespace AOCTest\Year2016\Day07;

use AOC\Year2016\Day07\PartOne;

class PartOneTest extends \AOCTest\Util\SolutionTest
{
    protected string $solutionClass = PartOne::class;

    /**
     * @inheritDoc
     */
    public function data(): array
    {
        return [
            [[$this->generatorFromFile(__DIR__ . DS . 'test_part1')], 2],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 118],
        ];
    }
}
