<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day01;

use AOC\Year2015\Day01\PartTwo;
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
            [[')'], 1],
            [['()())'], 5],
            [[$this->lineFromFile(__DIR__ . DS . 'input')], 1783],
        ];
    }
}
