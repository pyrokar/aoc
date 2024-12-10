<?php

declare(strict_types=1);

namespace AOCTest\Year2024\Day09;

use AOC\Year2024\Day09\PartTwo;
use AOCTest\Util\SolutionTestCase;
use Safe\Exceptions\FilesystemException;

final class PartTwoTest extends SolutionTestCase
{
    /** @var class-string */
    public string $solutionClass = PartTwo::class;


    /**
     * @throws FilesystemException
     *
     * @return array<int, array<mixed>>
     */
    #[\Override]
    public function data(): array
    {
        return [
            [[$this->lineFromFile(__DIR__ . DS . 'test')], 2858],
            //		    [[$this->lineFromFile(__DIR__ . DS . 'input')], 6265268809555],
        ];
    }
}
