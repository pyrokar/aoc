<?php

declare(strict_types=1);

namespace AOCTest\Year2016\Day09;

use AOCTest\Util\SolutionTestCase;
use AOC\Year2016\Day09\PartOne;
use Safe\Exceptions\FilesystemException;

class PartOneTest extends SolutionTestCase
{
    protected string $solutionClass = PartOne::class;

    /**
     * @inheritDoc
     *
     * @throws FilesystemException
     */
    #[\Override]
    public function data(): array
    {
        return [
            [[$this->generatorFromString('ADVENT')], 6],
            [[$this->generatorFromString('A(1x5)BC')], 7],
            [[$this->generatorFromString('(3x3)XYZ')], 9],
            [[$this->generatorFromString('A(2x2)BCD(2x2)EFG')], 11],
            [[$this->generatorFromString('(6x1)(1x3)A')], 6],
            [[$this->generatorFromString('X(8x2)(3x3)ABCY')], 18],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 102239],
        ];
    }
}
