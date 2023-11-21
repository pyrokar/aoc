<?php

declare(strict_types=1);

namespace AOCTest\Year2022\Day08;

use AOC\Year2022\Day08\PartTwo;
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
            [[$this->generatorFromFile(__DIR__ . DS . 'test'), 5], 8],
            [[$this->generatorFromFile(__DIR__ . DS . 'input'), 99], 392080],
        ];
    }
}
