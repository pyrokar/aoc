<?php

declare(strict_types=1);

namespace AOCTest\Year2024\Day13;

use AOC\Year2024\Day13\Solution;
use AOCTest\Util\SolutionTestCase;
use Safe\Exceptions\FilesystemException;

final class PartOneTest extends SolutionTestCase
{
    /** @var class-string */
    public string $solutionClass = Solution::class;


    /**
     * @throws FilesystemException
     *
     * @return array<int, array<mixed>>
     */
    #[\Override]
    public function data(): array
    {
        return [
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], 480],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 29438],
        ];
    }
}
