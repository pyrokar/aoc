<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day18;

use AOC\Year2015\Day18\PartTwo;
use AOC\Test\Util\SolutionTest;
use Safe\Exceptions\FilesystemException;

/**
 * @large
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
            [[$this->generatorFromFile(__DIR__ . DS . 'test.txt'), 6, 5], 17],
            [[$this->generatorFromFile(__DIR__ . DS . 'input.txt'), 100, 100], 924],
        ];
    }
}
