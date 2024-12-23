<?php

declare(strict_types=1);

namespace AOCTest\Year2024\Day07;

use AOC\Year2024\Day07\PartTwo;
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
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], 11387],
            //[[$this->generatorFromFile(__DIR__ . DS . 'input')], 92612386119138],
        ];
    }
}
