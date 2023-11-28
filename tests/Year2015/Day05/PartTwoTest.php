<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day05;

use AOC\Year2015\Day05\PartTwo;
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
     */
    public function data(): array
    {
        return [
            [[$this->generatorFromString('qjhvhtzxzqqjkmpb')], 1],
            [[$this->generatorFromString('xxyxx')], 1],
            [[$this->generatorFromString('uurcxstgmygtbstg')], 0],
            [[$this->generatorFromString('ieodomkazucvgmuy')], 0],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 55],
        ];
    }
}
