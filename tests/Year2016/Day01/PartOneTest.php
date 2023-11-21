<?php

declare(strict_types=1);

namespace AOCTest\Year2016\Day01;

use AOC\Year2016\Day01\PartOne;
use AOC\Test\Util\SolutionTest;
use Safe\Exceptions\FilesystemException;

class PartOneTest extends SolutionTest
{
    /** @var class-string */
    protected string $solutionClass = PartOne::class;

    /**
     * @throws FilesystemException
     *
     * @return array<int, array<mixed>>
     */
    public function data(): array
    {
        return [
            [[$this->generatorFromString('R2, L3')], 5],
            [[$this->generatorFromString('R2, R2, R2')], 2],
            [[$this->generatorFromString('R5, L5, R5, R3')], 12],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 301],
        ];
    }
}
