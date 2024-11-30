<?php

declare(strict_types=1);

namespace AOCTest\Year2023\Day15;

use AOC\Year2023\Day15\PartTwo;
use AOCTest\Util\SolutionTestCase;
use Safe\Exceptions\FilesystemException;

class PartTwoTest extends SolutionTestCase
{
    /** @var class-string */
    public string $solutionClass = PartTwo::class;

    /**
     * @throws FilesystemException
     *
     * @return array<int, array<mixed>>
     *
     */
    #[\Override]
    public function data(): array
    {
        return [
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], 145],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 230462],
        ];
    }
}
