<?php

declare(strict_types=1);

namespace AOCTest\Year2022\Day09;

use AOC\Year2022\Day09\PartTwo;
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
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], 1],
            [[$this->generatorFromFile(__DIR__ . DS . 'test2')], 36],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 2467],
        ];
    }
}
