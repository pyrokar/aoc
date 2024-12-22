<?php

declare(strict_types=1);

namespace AOCTest\Year2024\Day22;

use AOC\Year2024\Day22\PartTwo;
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
            [[$this->generatorFromString('123'), 9], 6],
            [[$this->generatorFromFile(__DIR__ . DS . 'test_2'), 2000], 23],
            //[[$this->generatorFromFile(__DIR__ . DS . 'input'), 2000], 1630],
        ];
    }
}
