<?php

declare(strict_types=1);

namespace AOCTest\Year2020\Day05;

use AOC\Year2020\Day05\PartOne;
use AOCTest\Util\SolutionTestCase;
use Safe\Exceptions\FilesystemException;

class PartOneTest extends SolutionTestCase
{
    /** @var class-string */
    public string $solutionClass = PartOne::class;

    /**
     * @throws FilesystemException
     *
     * @return array<int, array<mixed>>
     *
     */
    public function data(): array
    {
        return [
            [[$this->generatorFromString('FBFBBFFRLR')], 357],
            [[$this->generatorFromString('BFFFBBFRRR')], 567],
            [[$this->generatorFromString('FFFBBBFRRR')], 119],
            [[$this->generatorFromString('BBFFBBFRLL')], 820],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 883],
        ];
    }
}
