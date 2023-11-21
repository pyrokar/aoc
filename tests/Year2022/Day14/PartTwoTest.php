<?php

declare(strict_types=1);

namespace AOCTest\Year2022\Day14;

use AOC\Year2022\Day14\PartTwo;
use AOC\Test\Util\SolutionTest;

/**
 * @large
 */
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
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], 93],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 27623],
        ];
    }
}
