<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day01;

use AOC\Year2015\Day01\PartOne;
use AOC\Test\Util\SolutionTest;
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
            [['(())'], 0],
            [['()()'], 0],
            [['((('], 3],
            [['(()(()('], 3],
            [['))((((('], 3],
            [['())'], -1],
            [['))('], -1],
            [[')))'], -3],
            [[')())())'], -3],
            [[$this->lineFromFile(__DIR__ . DS . 'input.txt')], 232],
        ];
    }
}
