<?php

declare(strict_types=1);

namespace AOCTest\Year2022\Day09;

use AOC\Year2022\Day09\PartOne;
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
    #[\Override]
    public function data(): array
    {
        return [
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], 13],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 5874],
        ];
    }
}
