<?php

declare(strict_types=1);

namespace AOCTest\Year2023\Day16;

use AOC\Year2023\Day16\PartTwo;
use AOCTest\Util\SolutionTestCase;
use Safe\Exceptions\FilesystemException;

/**
 * @medium
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
    public function data(): array
    {
        return [
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], 51],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 8383],
        ];
    }
}
