<?php

declare(strict_types=1);

namespace AOCTest\Year2022\Day11;

use AOC\Year2022\Day11\PartOne;
use AOCTest\Util\SolutionTestCase;

/**
 * @group fail
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
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], 10605],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 151312],
        ];
    }
}
