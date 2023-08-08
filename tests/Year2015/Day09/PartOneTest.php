<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day09;

use AOC\Test\Util\SolutionTest;
use AOC\Year2015\Day09\PartOne;
use Safe\Exceptions\FilesystemException;

class PartOneTest extends SolutionTest
{
    /** @var class-string */
    public string $solutionClass = PartOne::class;

    /**
     * @return array<int, array<mixed>>
     * @throws FilesystemException
     */
    public function data(): array
    {
        return [
            [[$this->generatorFromFile(__DIR__ . DS . 'test.txt')], 605],
            [[$this->generatorFromFile(__DIR__ . DS . 'input.txt')], 207],
        ];
    }
}
