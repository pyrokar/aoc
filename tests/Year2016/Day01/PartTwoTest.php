<?php

declare(strict_types=1);

namespace AOCTest\Year2016\Day01;

use AOC\Year2016\Day01\PartTwo;
use AOCTest\Util\SolutionTestCase;
use Safe\Exceptions\FilesystemException;

class PartTwoTest extends SolutionTestCase
{
    /** @var class-string */
    protected string $solutionClass = PartTwo::class;

    /**
     * @throws FilesystemException
     *
     * @return array<int, array<mixed>>
     */
    public function data(): array
    {
        return [
            [[$this->generatorFromString('R8, R4, R4, R8')], 4],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 130],
        ];
    }
}
