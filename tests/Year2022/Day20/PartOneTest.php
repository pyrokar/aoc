<?php

declare(strict_types=1);

namespace AOCTest\Year2022\Day20;

use AOC\Year2022\Day20\PartOne;
use AOC\Test\Util\SolutionTest;

/**
 * @medium
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
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], 3],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 13967],
        ];
    }
}
