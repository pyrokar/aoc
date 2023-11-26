<?php

declare(strict_types=1);

namespace AOCTest\Year2020\Day01;

use AOC\Year2020\Day01\PartTwo;
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
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], 241861950],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 193598720],
        ];
    }
}
