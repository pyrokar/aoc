<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day02;

use AOC\Year2015\Day02\PartTwo;
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
    #[\Override]
    public function data(): array
    {
        return [
            [[$this->generatorFromString('2x3x4')], 34],
            [[$this->generatorFromString('1x1x10')], 14],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 3737498],
        ];
    }
}
