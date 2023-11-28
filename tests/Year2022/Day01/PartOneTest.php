<?php

declare(strict_types=1);

namespace AOCTest\Year2022\Day01;

use AOC\Year2022\Day01\PartOne;
use AOCTest\Util\SolutionTestCase;

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
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], 24000],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 71023],
        ];
    }
}
