<?php

declare(strict_types=1);

namespace AOCTest\Year2016\Day03;

use AOC\Year2016\Day03\PartOne;
use AOCTest\Util\SolutionTestCase;
use Override;

class PartOneTest extends SolutionTestCase
{
    /** @var class-string */
    public string $solutionClass = PartOne::class;

    /**
     * @return array<int, array<mixed>>
     */
    #[Override]
    public function data(): array
    {
        return [
            [[$this->generatorFromString('5 10 25')], 0],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 1050],
        ];
    }
}
