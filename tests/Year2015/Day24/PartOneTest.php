<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day24;

use AOC\Year2015\Day24\PartOne;
use AOCTest\Util\SolutionTestCase;
use Safe\Exceptions\FilesystemException;

/**
 * @medium
 */
class PartOneTest extends SolutionTestCase
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
            [[$this->generatorFromFile(__DIR__ . DS . 'test'), 3], 99],
            [[$this->generatorFromFile(__DIR__ . DS . 'input'), 3], 11846773891],
        ];
    }
}
