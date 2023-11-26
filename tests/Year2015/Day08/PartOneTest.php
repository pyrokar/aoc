<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day08;

use AOC\Year2015\Day08\PartOne;
use AOCTest\Util\SolutionTest;
use Safe\Exceptions\FilesystemException;

class PartOneTest extends SolutionTest
{
    /** @var class-string */
    public string $solutionClass = PartOne::class;

    /**
     * @throws FilesystemException
     *
     * @return array<int, array<mixed>>
     */
    public function data(): array
    {
        return [
            [[$this->generatorFromString('""')], 2],
            [[$this->generatorFromString('"abc"')], 2],
            [[$this->generatorFromString('"aaa\"aaa"')], 3],
            [[$this->generatorFromString('"\x27"')], 5],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 1333],
        ];
    }
}
