<?php

declare(strict_types=1);

namespace AOCTest\Year2023\Day10;

use AOC\Year2023\Day10\PartOne;
use AOCTest\Util\SolutionTestCase;
use Safe\Exceptions\FilesystemException;
use Override;

class PartOneTest extends SolutionTestCase
{
    /** @var class-string */
    public string $solutionClass = PartOne::class;

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
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], 4],
            [[$this->generatorFromFile(__DIR__ . DS . 'test_2')], 8],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 7102],
        ];
    }
}
