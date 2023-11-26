<?php

declare(strict_types=1);

namespace AOCTest\Year2022\Day07;

use AOC\Year2022\Day07\PartTwo;
use AOCTest\Util\SolutionTest;

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
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], 24933642],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 3866390],
        ];
    }
}
