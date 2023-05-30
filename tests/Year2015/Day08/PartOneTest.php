<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day08;

use AOC\Year2015\Day08\PartOne;
use AOC\Test\Util\SolutionTest;

class PartOneTest extends SolutionTest
{
    /** @var class-string */
    public string $solutionClass = PartOne::class;

    /**
     * @return array<int, array<mixed>>
     */
    public function data(): array
    {
        return [
            [['""'], 2],
            [['"abc"'], 2],
            [['"aaa\"aaa"'], 3],
            [['"\x27"'], 5],
            [['input.txt'], 1333],
        ];
    }
}
