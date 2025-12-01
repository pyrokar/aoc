<?php

declare(strict_types=1);

namespace AOCTest\Year2024\Day13;

use AOC\Year2024\Day13\Solution;
use AOCTest\Util\SolutionTestCase;
use Override;
use Safe\Exceptions\FilesystemException;

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
            [[$this->generatorFromFile(__DIR__ . DS . 'test'), 10000000000000], 875318608908],
            [[$this->generatorFromFile(__DIR__ . DS . 'input'), 10000000000000], 104958599303720],
        ];
    }
}
