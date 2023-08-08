<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day02;

use AOC\Year2015\Day02\PartTwo;
use AOC\Test\Util\SolutionTest;
use Safe\Exceptions\FilesystemException;

class PartTwoTest extends SolutionTest
{
    /** @var class-string */
    public string $solutionClass = PartTwo::class;

    /**
     * @return array<int, array<mixed>>
     * @throws FilesystemException
     */
    public function data(): array
    {
        return [
            [[$this->generatorFromString('2x3x4')], 34],
            [[$this->generatorFromString('1x1x10')], 14],
            [[$this->generatorFromFile(__DIR__ . DS . 'input.txt')], 3737498],
        ];
    }
}
