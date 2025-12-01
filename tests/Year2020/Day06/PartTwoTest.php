<?php

declare(strict_types=1);

namespace AOCTest\Year2020\Day06;

use AOC\Year2020\Day06\PartTwo;
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
     */
    #[Override]
    public function data(): array
    {
        return [
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], 6],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 3050],
        ];
    }
}
