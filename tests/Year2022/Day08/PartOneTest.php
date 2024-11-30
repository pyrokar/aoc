<?php

declare(strict_types=1);

namespace AOCTest\Year2022\Day08;

use AOC\Year2022\Day08\PartOne;
use AOCTest\Util\SolutionTestCase;

class PartOneTest extends SolutionTestCase
{
    /** @var class-string */
    public string $solutionClass = PartOne::class;

    /**
     * @return array<int, array<mixed>>
     */
    #[\Override]
    public function data(): array
    {
        return [
            [[$this->generatorFromFile(__DIR__ . DS . 'test'), 5], 21],
            [[$this->generatorFromFile(__DIR__ . DS . 'input'), 99], 1647],
        ];
    }
}
