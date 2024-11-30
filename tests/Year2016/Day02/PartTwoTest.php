<?php

declare(strict_types=1);

namespace AOCTest\Year2016\Day02;

use AOC\Year2016\Day02\PartTwo;
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
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], '5DB3'],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], '46C91'],
        ];
    }
}
