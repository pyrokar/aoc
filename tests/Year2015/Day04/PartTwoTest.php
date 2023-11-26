<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day04;

use AOC\Year2015\Day04\PartTwo;
use AOCTest\Util\SolutionTest;

/**
 * @medium
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
            [['bgvyzdsv'], 1038736],
        ];
    }
}
