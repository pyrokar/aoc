<?php

declare(strict_types=1);

namespace AOCTest\Year2022\Day23;

use AOC\Year2022\Day23\PartOne;
use AOCTest\Util\SolutionTestCase;
use Override;
use PHPUnit\Framework\Attributes\Medium;

#[Medium]
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
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], 25],
            [[$this->generatorFromFile(__DIR__ . DS . 'test_2')], 110],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 4249],
        ];
    }
}
