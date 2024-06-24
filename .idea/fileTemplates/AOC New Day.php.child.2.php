<?php

declare(strict_types=1);

namespace AOCTest\Year${Year}\Day${Day};

use AOC\Year${Year}\Day${Day}\PartTwo;
use AOCTest\Util\SolutionTestCase;
use Safe\Exceptions\FilesystemException;

/**
 * @small
 */
class PartTwoTest extends SolutionTestCase
{
    /** @var class-string */
    public string ${DS}solutionClass = PartTwo::class;

    /**
     * @throws FilesystemException
     *
     * @return array<int, array<mixed>>
     */
    public function data(): array
    {
        return [
            [[${DS}this->generatorFromFile(__DIR__ . DS . 'test')], 0],
            [[${DS}this->generatorFromFile(__DIR__ . DS . 'input')], 0],
        ];
    }
}
