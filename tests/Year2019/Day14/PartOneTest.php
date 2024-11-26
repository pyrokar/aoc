<?php

declare(strict_types=1);

namespace AOCTest\Year2019\Day14;

use AOC\Year2019\Day14\PartOne;
use AOCTest\Util\SolutionTestCase;
use Safe\Exceptions\FilesystemException;

final class PartOneTest extends SolutionTestCase
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
            [[$this->generatorFromFile(__DIR__ . DS . 'test_1')], 13312],
            [[$this->generatorFromFile(__DIR__ . DS . 'test_2')], 180697],
            [[$this->generatorFromFile(__DIR__ . DS . 'test_3')], 2210736],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 2556890],
        ];
    }
}
