<?php

declare(strict_types=1);

namespace AOCTest\Year2023\Day15;

use AOC\Year2023\Day15\PartOne;
use AOCTest\Util\SolutionTestCase;
use Safe\Exceptions\FilesystemException;
use Override;

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
    #[Override]
    public function data(): array
    {
        return [
            [[$this->generatorFromString('HASH')], 52],
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], 1320],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 506891],
        ];
    }
}
