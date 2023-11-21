<?php

declare(strict_types=1);

namespace AOCTest\Year2016\Day02;

use AOC\Year2016\Day02\PartTwo;
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
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], '5DB3'],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], '46C91'],
        ];
    }
}
