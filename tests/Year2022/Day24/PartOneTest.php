<?php

declare(strict_types=1);

namespace AOCTest\Year2022\Day24;

use AOC\Year2022\Day24\PartOne;
use AOCTest\Util\SolutionTestCase;

/**
 * @large
 */
class PartOneTest extends SolutionTestCase
{
    /** @var class-string */
    public string $solutionClass = PartOne::class;

    /**
     * @return array<int, array<mixed>>
     */
    public function data(): array
    {
        return [
            [[$this->generatorFromFile(__DIR__ . DS . 'test'), 6, 4], 18],
            [[$this->generatorFromFile(__DIR__ . DS . 'input'), 100, 35], 230],
        ];
    }
}
