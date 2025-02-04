<?php

declare(strict_types=1);

namespace AOCTest\Year2023\Day11;

use AOC\Year2023\Day11\Solution;
use AOCTest\Util\SolutionTestCase;
use Safe\Exceptions\FilesystemException;
use Override;

class PartOneTest extends SolutionTestCase
{
    /** @var class-string */
    public string $solutionClass = Solution::class;

    /**
     * @throws FilesystemException
     *
     * @return array<int, array<mixed>>
     *
     */
    #[Override]
    public function data(): array
    {
        return [
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], 374],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 9543156],
        ];
    }
}
