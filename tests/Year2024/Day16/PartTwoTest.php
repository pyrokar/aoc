<?php

declare(strict_types=1);

namespace AOCTest\Year2024\Day16;

use AOC\Year2024\Day16\PartTwo;
use AOCTest\Util\SolutionTestCase;
use Safe\Exceptions\FilesystemException;
use Override;

final class PartTwoTest extends SolutionTestCase
{
    /** @var class-string */
    public string $solutionClass = PartTwo::class;

    /**
     * @throws FilesystemException
     *
     * @return array<int, array<mixed>>
     */
    #[Override]
    public function data(): array
    {
        return [
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], 45],
            [[$this->generatorFromFile(__DIR__ . DS . 'test_2')], 64],
            //[[$this->generatorFromFile(__DIR__ . DS . 'input')], 500],
        ];
    }
}
