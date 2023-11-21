<?php

declare(strict_types=1);

namespace AOCTest\Year2016\Day10;

use AOC\Year2016\Day10\PartTwo;
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
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], 30],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 1085],
        ];
    }
}
