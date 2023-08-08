<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day15;

use AOC\Year2015\Day15\PartTwo;
use AOC\Test\Util\SolutionTest;
use Safe\Exceptions\FilesystemException;

/**
 * @medium
 */
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
            [[$this->generatorFromFile(__DIR__ . DS . 'test.txt')], 57600000],
            [[$this->generatorFromFile(__DIR__ . DS . 'input.txt')], 15862900],
        ];
    }
}
