<?php

declare(strict_types=1);

namespace AOCTest\Year2019\Day05;

use AOC\Year2019\Day05\Solution;
use AOCTest\Util\SolutionTestCase;
use Safe\Exceptions\FilesystemException;
use Override;
use PHPUnit\Framework\Attributes\Group;

#[Group('intcodecomputer')]
final class PartTwoTest extends SolutionTestCase
{
    /** @var class-string */
    public string $solutionClass = Solution::class;

    /**
     * @throws FilesystemException
     *
     * @return array<int, array<mixed>>
     */
    #[Override]
    public function data(): array
    {
        return [
            [[$this->generatorFromString('3,9,8,9,10,9,4,9,99,-1,8'), 8], 1],
            [[$this->generatorFromString('3,9,8,9,10,9,4,9,99,-1,8'), 99], 0],
            [[$this->generatorFromString('3,3,1108,-1,8,3,4,3,99'), 8], 1],
            [[$this->generatorFromString('3,3,1108,-1,8,3,4,3,99'), 99], 0],

            [[$this->generatorFromString('3,12,6,12,15,1,13,14,13,4,13,99,-1,0,1,9'), 0], 0],
            [[$this->generatorFromString('3,12,6,12,15,1,13,14,13,4,13,99,-1,0,1,9'), 12], 1],
            [[$this->generatorFromString('3,3,1105,-1,9,1101,0,0,12,4,12,99,1'), 0], 0],
            [[$this->generatorFromString('3,3,1105,-1,9,1101,0,0,12,4,12,99,1'), 12], 1],

            [[$this->generatorFromFile(__DIR__ . DS . 'test'), 7], 999],
            [[$this->generatorFromFile(__DIR__ . DS . 'test'), 8], 1000],
            [[$this->generatorFromFile(__DIR__ . DS . 'test'), 9], 1001],
            [[$this->generatorFromFile(__DIR__ . DS . 'input'), 5], 9571668],
        ];
    }
}
