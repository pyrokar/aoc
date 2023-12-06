<?php

declare(strict_types=1);

namespace AOCTest\Year2023\Day05;

use AOC\Year2023\Day05\PartTwo;
use AOCTest\Util\SolutionTestCase;
use Safe\Exceptions\FilesystemException;

class PartTwoTest extends SolutionTestCase
{
    /** @var class-string */
    public string $solutionClass = PartTwo::class;

    /**
     * @return array<int, array<mixed>>
     * @throws FilesystemException
     *
     */
    public function data(): array
    {
        return [
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], 46],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 56931769],
        ];
    }
}
