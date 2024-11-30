<?php

declare(strict_types=1);

namespace AOCTest\Year2019\Day07;

use AOC\Year2019\Day07\PartOne;
use AOCTest\Util\SolutionTestCase;
use Safe\Exceptions\FilesystemException;

/**
 * @group intcodecomputer
 */
final class PartOneTest extends SolutionTestCase
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
            [['3,15,3,16,1002,16,10,16,1,16,15,15,4,15,99,0,0'], 43210],
            [['3,23,3,24,1002,24,10,24,1002,23,-1,23,101,5,23,23,1,24,23,23,4,23,99,0,0'], 54321],
            [['3,31,3,32,1002,32,10,32,1001,31,-2,31,1007,31,0,33,1002,33,7,33,1,33,31,31,1,32,31,31,4,31,99,0,0,0'], 65210],
            [[$this->lineFromFile(__DIR__ . DS . 'input')], 262086],
        ];
    }
}
