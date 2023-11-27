<?php

declare(strict_types=1);

namespace AOCTest\Year2020\Day04;

use AOC\Year2020\Day04\PartTwo;
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
     *
     */
    public function data(): array
    {
        return [
            [[$this->generatorFromFile(__DIR__ . DS . 'test_valid')], 4],
            [[$this->generatorFromFile(__DIR__ . DS . 'test_invalid')], 0],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 137],
        ];
    }
}
