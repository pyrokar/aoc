<?php

declare(strict_types=1);

namespace AOCTest\Year2016\Day20;

use AOC\Year2016\Day20\PartTwo;
use AOCTest\Util\SolutionTestCase;
use Safe\Exceptions\FilesystemException;

/**
 * @small
 */
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
            [[$this->generatorFromFile(__DIR__ . DS . 'test'), 9 + 1], 2],
            [[$this->generatorFromFile(__DIR__ . DS . 'input'), 4294967295 + 1], 125],
        ];
    }
}
