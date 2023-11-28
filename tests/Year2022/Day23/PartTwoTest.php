<?php

declare(strict_types=1);

namespace AOCTest\Year2022\Day23;

use AOC\Year2022\Day23\PartTwo;
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
    public function data(): array
    {
        return [
            [[$this->generatorFromFile(__DIR__ . DS . 'test_2')], 20],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 980],
        ];
    }
}
