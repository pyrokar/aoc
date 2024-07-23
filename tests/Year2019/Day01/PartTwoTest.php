<?php

declare(strict_types=1);

namespace AOCTest\Year2019\Day01;

use AOC\Year2019\Day01\PartTwo;
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
            [[$this->generatorFromString('100756')], 50346],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 4773483],
        ];
    }
}
