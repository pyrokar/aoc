<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day18;

use AOC\Year2015\Day18\PartOne;
use AOCTest\Util\SolutionTest;
use Safe\Exceptions\FilesystemException;

/**
 * @large
 */
class PartOneTest extends SolutionTest
{
    /** @var class-string */
    public string $solutionClass = PartOne::class;

    /**
     * @throws FilesystemException
     *
     * @return array<int, array<mixed>>
     */
    public function data(): array
    {
        return [
            [[$this->generatorFromFile(__DIR__ . DS . 'test'), 6, 4], 4],
            [[$this->generatorFromFile(__DIR__ . DS . 'input'), 100, 100], 814],
        ];
    }
}
