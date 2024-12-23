<?php

declare(strict_types=1);

namespace AOCTest\Year2023\Day14;

use AOC\Year2023\Day14\PartTwo;
use AOCTest\Util\SolutionTestCase;
use Safe\Exceptions\FilesystemException;
use Override;

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
    #[Override]
    public function data(): array
    {
        return [
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], 64],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 96061],
        ];
    }
}
