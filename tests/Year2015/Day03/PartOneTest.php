<?php
declare(strict_types=1);

namespace AOCTest\Year2015\Day03;

use AOC\Year2015\Day03\PartOne;
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
            [['>'], 2],
            [['^>v<'], 4],
            [['^v^v^v^v^v'], 2],
            [['input.txt'], 2081],
        ];
    }
}
