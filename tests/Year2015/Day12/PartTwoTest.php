<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day12;

use AOC\Year2015\Day12\PartTwo;
use AOCTest\Util\SolutionTestCase;
use Safe\Exceptions\FilesystemException;

class PartTwoTest extends SolutionTestCase
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
            [[$this->lineFromFile(__DIR__ . DS . 'test.json')], 11],
            [[$this->lineFromFile(__DIR__ . DS . 'input.json')], 68466],
        ];
    }
}
