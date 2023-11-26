<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day02;

use AOC\Year2015\Day02\PartOne;
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
            [[$this->generatorFromString('2x3x4')], 58],
            [[$this->generatorFromString('1x1x10')], 43],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 1586300],
        ];
    }
}
