<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day03;

use AOC\Year2015\Day03\PartTwo;
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
            [['^v'], 3],
            [['^>v<'], 3],
            [['^v^v^v^v^v'], 11],
            [[$this->lineFromFile(__dir__ . DS . 'input')], 2341],
        ];
    }
}
