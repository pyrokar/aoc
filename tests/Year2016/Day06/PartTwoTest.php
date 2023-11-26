<?php

declare(strict_types=1);

namespace AOCTest\Year2016\Day06;

use AOCTest\Util\SolutionTest;
use AOC\Year2016\Day06\PartTwo;
use Safe\Exceptions\FilesystemException;

class PartTwoTest extends SolutionTest
{
    protected string $solutionClass = PartTwo::class;
    /**
     * @inheritDoc
     *
     * @throws FilesystemException
     */
    public function data(): array
    {
        return [
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], 'advent'],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 'pdesmnoz'],
        ];
    }
}
