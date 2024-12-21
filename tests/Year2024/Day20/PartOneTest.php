<?php

declare(strict_types=1);

namespace AOCTest\Year2024\Day20;

use AOC\Year2024\Day20\PartOne;
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
    #[\Override]
    public function data(): array
    {
        return [
            [[$this->generatorFromFile(__DIR__ . DS . 'test'), 15, 15, 1], 44],
            [[$this->generatorFromFile(__DIR__ . DS . 'input'), 141, 141, 100], 1485],
        ];
    }
}
