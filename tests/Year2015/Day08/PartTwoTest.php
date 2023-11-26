<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day08;

use AOC\Year2015\Day08\PartTwo;
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
            [[$this->generatorFromString('""')], 4],
            [[$this->generatorFromString('"abc"')], 4],
            [[$this->generatorFromString('"aaa\"aaa"')], 6],
            [[$this->generatorFromString('"\x27"')], 5],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 2046],
        ];
    }
}
