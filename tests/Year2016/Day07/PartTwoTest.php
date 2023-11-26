<?php

declare(strict_types=1);

namespace AOCTest\Year2016\Day07;

use AOC\Year2016\Day07\PartTwo;
use Safe\Exceptions\FilesystemException;

class PartTwoTest extends \AOCTest\Util\SolutionTest
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
            [[$this->generatorFromFile(__DIR__ . DS . 'test_part2')], 3],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 260],
        ];
    }
}
