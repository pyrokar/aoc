<?php

declare(strict_types=1);

namespace AOCTest\Year2019\Day05;

use AOC\Year2019\Day05\Solution;
use AOCTest\Util\SolutionTestCase;
use Safe\Exceptions\FilesystemException;

/**
 * @group intcodecomputer
 */
final class PartOneTest extends SolutionTestCase
{
    /** @var class-string */
    public string $solutionClass = Solution::class;


    /**
     * @throws FilesystemException
     *
     * @return array<int, array<mixed>>
     */
    public function data(): array
    {
        return [
            [[$this->generatorFromString('1002,7,3,7,4,7,99,33')], 99],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 6731945],
        ];
    }
}
