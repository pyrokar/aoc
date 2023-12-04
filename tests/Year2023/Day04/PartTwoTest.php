<?php

declare(strict_types=1);

namespace AOCTest\Year2023\Day04;

use AOC\Year2023\Day04\PartTwo;
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
     *
     */
    public function data(): array
    {
        return [
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], 30],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 6050769],
        ];
    }
}
