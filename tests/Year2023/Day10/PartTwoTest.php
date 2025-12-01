<?php

declare(strict_types=1);

namespace AOCTest\Year2023\Day10;

use AOC\Year2023\Day10\PartTwo;
use AOCTest\Util\SolutionTestCase;
use Override;
use Safe\Exceptions\FilesystemException;

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
    #[Override]
    public function data(): array
    {
        return [
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], 1],
            [[$this->generatorFromFile(__DIR__ . DS . 'test_2')], 1],
            [[$this->generatorFromFile(__DIR__ . DS . 'test_3')], 4],
            [[$this->generatorFromFile(__DIR__ . DS . 'test_4')], 8],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 363],
        ];
    }
}
