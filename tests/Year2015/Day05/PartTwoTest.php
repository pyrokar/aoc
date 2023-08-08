<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day05;

use AOC\Year2015\Day05\PartTwo;
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
            [[$this->generatorFromString('qjhvhtzxzqqjkmpb')], 1],
            [[$this->generatorFromString('xxyxx')], 1],
            [[$this->generatorFromString('uurcxstgmygtbstg')], 0],
            [[$this->generatorFromString('ieodomkazucvgmuy')], 0],
            [[$this->generatorFromFile(__DIR__ . DS . 'input.txt')], 55],
        ];
    }
}
