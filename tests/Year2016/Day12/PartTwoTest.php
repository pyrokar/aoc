<?php

declare(strict_types=1);

namespace AOCTest\Year2016\Day12;

use AOCTest\Util\SolutionTestCase;
use AOC\Year2016\Day12\PartTwo;
use Safe\Exceptions\FilesystemException;
use Override;

/**
 * @large
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
    #[Override]
    public function data(): array
    {
        return [
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 9227661],
        ];
    }
}
