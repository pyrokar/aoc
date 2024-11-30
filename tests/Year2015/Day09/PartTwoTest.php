<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day09;

use AOCTest\Util\SolutionTestCase;
use AOC\Year2015\Day09\PartTwo;
use Safe\Exceptions\FilesystemException;

/**
 * @internal
 *
 * @coversNothing
 */
class PartTwoTest extends SolutionTestCase
{
    /** @var class-string */
    public string $solutionClass = PartTwo::class;

    /**
     * @throws FilesystemException
     *
     * @return array<int, array<mixed>>
     */
    #[\Override]
    public function data(): array
    {
        return [
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], 982],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 804],
        ];
    }
}
