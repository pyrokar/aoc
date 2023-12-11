<?php

declare(strict_types=1);

namespace AOCTest\Year2023\Day11;

use AOC\Year2023\Day11\Solution;
use AOCTest\Util\SolutionTestCase;
use Safe\Exceptions\FilesystemException;

class PartTwoTest extends SolutionTestCase
{
    /** @var class-string */
    public string $solutionClass = Solution::class;

    /**
     * @throws FilesystemException
     *
     * @return array<int, array<mixed>>
     *
     */
    public function data(): array
    {
        return [
            [[$this->generatorFromFile(__DIR__ . DS . 'test'), 9], 1030],
            [[$this->generatorFromFile(__DIR__ . DS . 'test'), 99], 8410],
            [[$this->generatorFromFile(__DIR__ . DS . 'input'), 999999], 625243292686],
        ];
    }
}
