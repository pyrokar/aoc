<?php

declare(strict_types=1);

namespace AOCTest\Year2022\Day17;

use AOC\Year2022\Day17\PartTwo;
use AOCTest\Util\SolutionTestCase;
use Override;

/**
 * @large
 */
class PartTwoTest extends SolutionTestCase
{
    /** @var class-string */
    public string $solutionClass = PartTwo::class;

    /**
     * @return array<int, array<mixed>>
     */
    #[Override]
    public function data(): array
    {
        return [
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], 1514285714288],
            //[[$this->generatorFromFile(__DIR__ . DS . 'input')], 0],
        ];
    }
}
