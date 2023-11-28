<?php

declare(strict_types=1);

namespace AOCTest\Year2022\Day03;

use AOC\Year2022\Day03\PartTwo;
use AOCTest\Util\SolutionTestCase;

class PartTwoTest extends SolutionTestCase
{
    /** @var class-string */
    public string $solutionClass = PartTwo::class;

    /**
     * @return array<int, array<mixed>>
     */
    public function data(): array
    {
        return [
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], 70],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 2697],
        ];
    }
}
