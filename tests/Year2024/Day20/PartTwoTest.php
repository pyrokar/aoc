<?php

declare(strict_types=1);

namespace AOCTest\Year2024\Day20;

use AOC\Year2024\Day20\PartTwo;
use AOCTest\Util\SolutionTestCase;
use Safe\Exceptions\FilesystemException;

final class PartTwoTest extends SolutionTestCase
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
            [[$this->generatorFromFile(__DIR__ . DS . 'test'), 15, 15, 50], 285],
            //[[$this->generatorFromFile(__DIR__ . DS . 'input'), 141, 141, 100], 1027501],
        ];
    }
}
