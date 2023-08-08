<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day03;

use AOC\Year2015\Day03\PartTwo;
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
            [['^v'], 3],
            [['^>v<'], 3],
            [['^v^v^v^v^v'], 11],
            [[$this->lineFromFile(__dir__ . DS . 'input.txt')], 2341],
        ];
    }
}
