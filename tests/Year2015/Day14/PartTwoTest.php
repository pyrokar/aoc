<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day14;

use AOC\Year2015\Day14\PartTwo;
use AOC\Test\Util\SolutionTest;
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
            [[$this->generatorFromFile(__DIR__ . DS . 'test'), 1000], 689],
            [[$this->generatorFromFile(__DIR__ . DS . 'input'), 2503], 1256],
        ];
    }
}
