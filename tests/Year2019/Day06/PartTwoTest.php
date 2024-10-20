<?php

declare(strict_types=1);

namespace AOCTest\Year2019\Day06;

use AOC\Year2019\Day06\PartTwo;
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
    public function data(): array
    {
        return [
            [[$this->generatorFromFile(__DIR__ . DS . 'test_2')], 4],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 337],
        ];
    }
}
