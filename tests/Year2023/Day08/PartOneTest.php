<?php

declare(strict_types=1);

namespace AOCTest\Year2023\Day08;

use AOC\Year2023\Day08\PartOne;
use AOCTest\Util\SolutionTestCase;
use Safe\Exceptions\FilesystemException;

class PartOneTest extends SolutionTestCase
{
    /** @var class-string */
    public string $solutionClass = PartOne::class;

    /**
     * @throws FilesystemException
     *
     * @return array<int, array<mixed>>
     *
     */
    #[\Override]
    public function data(): array
    {
        return [
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], 2],
            [[$this->generatorFromFile(__DIR__ . DS . 'test_2')], 6],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 19241],
        ];
    }
}
