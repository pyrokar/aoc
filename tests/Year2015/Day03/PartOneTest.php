<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day03;

use AOC\Year2015\Day03\PartOne;
use AOCTest\Util\SolutionTestCase;
use Safe\Exceptions\FilesystemException;

class PartOneTest extends SolutionTestCase
{
    /** @var class-string */
    public string $solutionClass = PartOne::class;

    /**
     * @throws FilesystemException
     *
     * @return array<int, array<mixed>>
     */
    public function data(): array
    {
        return [
            [['>'], 2],
            [['^>v<'], 4],
            [['^v^v^v^v^v'], 2],
            [[$this->lineFromFile(__dir__ . DS . 'input')], 2081],
        ];
    }
}
