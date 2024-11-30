<?php

declare(strict_types=1);

namespace AOCTest\Year2019\Day08;

use AOC\Year2019\Day08\PartTwo;
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
            //[['0222112222120000', 2, 2], '0110'],
            //[[$this->lineFromFile(__DIR__ . DS . 'input'), 25, 6], '011001111010010001101000110010000101010000010100011000000100110000001001010101100100010100000100010010010100001010010010001000111011110100100110000100'],
        ];
    }
}
