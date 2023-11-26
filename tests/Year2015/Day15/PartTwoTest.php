<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day15;

use AOC\Year2015\Day15\PartTwo;
use AOCTest\Util\SolutionTest;
use Safe\Exceptions\FilesystemException;

/**
 * @medium
 */
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
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], 57600000],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 15862900],
        ];
    }
}
