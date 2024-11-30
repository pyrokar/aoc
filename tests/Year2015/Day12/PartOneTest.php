<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day12;

use AOC\Year2015\Day12\PartOne;
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
    #[\Override]
    public function data(): array
    {
        return [
            [[$this->lineFromFile(__DIR__ . DS . 'test.json')], 18],
            [[$this->lineFromFile(__DIR__ . DS . 'input.json')], 119433],
        ];
    }
}
