<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day24;

use AOC\Year2015\Day24\PartTwo;
use AOCTest\Util\SolutionTest;
use Safe\Exceptions\FilesystemException;

class PartTwoTest extends SolutionTest
{
    /** @var class-string */
    public string $solutionClass = PartTwo::class;

    /**
     * @throws FilesystemException
     *
     * @return array<int, array<mixed>>
     */
    public function data(): array
    {
        return [
            [[$this->generatorFromFile(__DIR__ . DS . 'test'), 4], 44],
            [[$this->generatorFromFile(__DIR__ . DS . 'input'), 4], 80393059],
        ];
    }
}
