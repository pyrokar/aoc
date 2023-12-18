<?php

declare(strict_types=1);

namespace AOCTest\Year2023\Day18;

use AOC\Year2023\Day18\PartTwo;
use AOCTest\Util\SolutionTestCase;
use Safe\Exceptions\FilesystemException;
use Override;

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
    #[Override]
    public function data(): array
    {
        return [
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], 952408144115],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 40654918441248],
        ];
    }
}
