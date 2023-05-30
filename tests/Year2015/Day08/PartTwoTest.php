<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day08;

use AOC\Year2015\Day08\PartTwo;
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
            [['""'], 4],
            [['"abc"'], 4],
            [['"aaa\"aaa"'], 6],
            [['"\x27"'], 5],
            [['input.txt'], 2046],
        ];
    }
}
