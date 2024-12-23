<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day01;

use AOC\Year2015\Day01\PartTwo;
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
            [[')'], 1],
            [['()())'], 5],
            [[$this->lineFromFile(__DIR__ . DS . 'input')], 1783],
        ];
    }
}
