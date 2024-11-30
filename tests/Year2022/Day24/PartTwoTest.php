<?php

declare(strict_types=1);

namespace AOCTest\Year2022\Day24;

use AOC\Year2022\Day24\PartTwo;
use AOCTest\Util\SolutionTestCase;

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
    #[\Override]
    public function data(): array
    {
        return [
            [[$this->generatorFromFile(__DIR__ . DS . 'test'), 6, 4], 54],
            [[$this->generatorFromFile(__DIR__ . DS . 'input'), 100, 35], 713],
        ];
    }
}
