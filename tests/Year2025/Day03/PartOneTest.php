<?php

declare(strict_types=1);

namespace AOCTest\Year2025\Day03;

use AOC\Year2025\Day03\Solution;
use AOCTest\Util\SolutionTestCase;
use Override;
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
    #[Override]
    public function data(): array
    {
        return [
            [[$this->generatorFromFile(__DIR__ . DS . 'test'), 2], 357],
            [[$this->generatorFromFile(__DIR__ . DS . 'input'), 2], 17092],
        ];
    }
}
