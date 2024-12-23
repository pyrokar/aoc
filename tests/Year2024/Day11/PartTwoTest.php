<?php

declare(strict_types=1);

namespace AOCTest\Year2024\Day11;

use AOC\Year2024\Day11\Solution;
use AOCTest\Util\SolutionTestCase;
use Safe\Exceptions\FilesystemException;
use Override;

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
            [[$this->lineFromFile(__DIR__ . DS . 'input'), 75], 259593838049805],
        ];
    }
}
