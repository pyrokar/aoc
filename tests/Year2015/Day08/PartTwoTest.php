<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day08;

use AOC\Year2015\Day08\PartTwo;
use AOCTest\Util\SolutionTestCase;
use Safe\Exceptions\FilesystemException;
use Override;

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
            [[$this->generatorFromString('""')], 4],
            [[$this->generatorFromString('"abc"')], 4],
            [[$this->generatorFromString('"aaa\"aaa"')], 6],
            [[$this->generatorFromString('"\x27"')], 5],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 2046],
        ];
    }
}
