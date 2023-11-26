<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day17;

use AOC\Year2015\Day17\PartTwo;
use AOCTest\Util\SolutionTest;
use Safe\Exceptions\FilesystemException;

/**
 * @small
 */
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
            [[$this->generatorFromFile(__DIR__ . DS . 'test'), 25], 3],
            [[$this->generatorFromFile(__DIR__ . DS . 'input'), 150], 17],
        ];
    }
}
