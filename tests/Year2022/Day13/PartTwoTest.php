<?php

declare(strict_types=1);

namespace AOCTest\Year2022\Day13;

use AOC\Year2022\Day13\PartTwo;
use AOCTest\Util\SolutionTestCase;

class PartTwoTest extends SolutionTestCase
{
    /** @var class-string */
    public string $solutionClass = PartTwo::class;

    /**
     * @return array<int, array<mixed>>
     */
    #[\Override]
    public function data(): array
    {
        return [
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], 140],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 24948],
        ];
    }
}
