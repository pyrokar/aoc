<?php

declare(strict_types=1);

namespace AOCTest\Year2016\Day10;

use AOC\Year2016\Day10\PartTwo;
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
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], 30],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 1085],
        ];
    }
}
