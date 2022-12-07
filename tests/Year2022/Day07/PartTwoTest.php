<?php declare(strict_types=1);

namespace AOCTest\Year2022\Day07;

use AOC\Year2022\Day07\PartTwo;
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
            [['test'], 24933642],
            [['input'], 3866390],
        ];
    }
}
