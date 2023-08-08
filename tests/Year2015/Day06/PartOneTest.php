<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day06;

use AOC\Year2015\Day06\PartOne;
use AOC\Test\Util\SolutionTest;
use Safe\Exceptions\FilesystemException;

/**
 * @large
 */
class PartOneTest extends SolutionTest
{
    /** @var class-string */
    public string $solutionClass = PartOne::class;

    /**
     * @return array<int, array<mixed>>
     * @throws FilesystemException
     */
    public function data(): array
    {
        return [
            [[$this->generatorFromString('turn on 0,0 through 999,999')], 1000000],
            [[$this->generatorFromString('turn off 0,0 through 999,999')], 0],
            [[$this->generatorFromFile(__DIR__ . DS . 'input.txt')], 569999],
        ];
    }
}
