<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day10;

use AOCTest\Util\SolutionTestCase;
use AOC\Year2015\Day10\PartTwo;

/**
 * @medium
 */
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
            [['3113322113', 40], 329356],
            [['3113322113', 50], 4666278],
        ];
    }
}
