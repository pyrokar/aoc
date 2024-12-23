<?php

declare(strict_types=1);

namespace AOCTest\Year2022\Day09;

use AOC\Year2022\Day09\PartTwo;
use AOCTest\Util\SolutionTestCase;
use Override;

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
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], 1],
            [[$this->generatorFromFile(__DIR__ . DS . 'test2')], 36],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 2467],
        ];
    }
}
