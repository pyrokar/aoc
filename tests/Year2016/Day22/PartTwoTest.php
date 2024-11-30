<?php

declare(strict_types=1);

namespace AOCTest\Year2016\Day22;

use AOC\Year2016\Day22\PartTwo;
use AOCTest\Util\SolutionTestCase;
use Safe\Exceptions\FilesystemException;

/**
 * @small
 */
class PartTwoTest extends SolutionTestCase
{
    /** @var class-string */
    public string $solutionClass = PartTwo::class;

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
            //[[$this->generatorFromFile(__DIR__ . DS . 'test'), 3, 3], 7],
            //[[$this->generatorFromFile(__DIR__ . DS . 'input'), 37, 28], 242],
        ];
    }
}
