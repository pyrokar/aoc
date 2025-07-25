<?php

declare(strict_types=1);

namespace AOCTest\Year2019\Day09;

use AOC\Year2019\Day09\Solution;
use AOCTest\Util\SolutionTestCase;
use Safe\Exceptions\FilesystemException;
use Override;
use PHPUnit\Framework\Attributes\Group;

#[Group('intcodecomputer')]
final class PartOneTest extends SolutionTestCase
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
            [['109,1,204,-1,1001,100,1,100,1008,100,16,101,1006,101,0,99'], '109,1,204,-1,1001,100,1,100,1008,100,16,101,1006,101,0,99'],
            [['1102,34915192,34915192,7,4,7,99,0'], '1219070632396864'],
            [['104,1125899906842624,99'], '1125899906842624'],
            [[$this->lineFromFile(__DIR__ . DS . 'input')], '3638931938'],
        ];
    }
}
