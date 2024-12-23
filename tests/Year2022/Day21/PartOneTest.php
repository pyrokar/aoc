<?php

declare(strict_types=1);

namespace AOCTest\Year2022\Day21;

use AOC\Year2022\Day21\PartOne;
use AOCTest\Util\SolutionTestCase;
use Override;

class PartOneTest extends SolutionTestCase
{
    /** @var class-string */
    public string $solutionClass = PartOne::class;

    /**
     * @return array<int, array<mixed>>
     */
    #[Override]
    public function data(): array
    {
        return [
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], 152],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 379578518396784],
        ];
    }
}
