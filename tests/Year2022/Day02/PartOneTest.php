<?php declare(strict_types=1);

namespace AOCTest\Year2022\Day02;

use AOC\Year2022\Day02\PartOne;
use AOC\Test\Util\SolutionTest;

/**
 * @large
 */
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
            [['test'], 15],
            [['input'], 13052],
        ];
    }
}
