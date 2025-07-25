<?php

declare(strict_types=1);

namespace AOCTest\Year2019\Day09;

use AOC\Year2019\Day09\Solution;
use AOCTest\Util\SolutionTestCase;
use Safe\Exceptions\FilesystemException;
use Override;
use PHPUnit\Framework\Attributes\Large;

#[Large]
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
            [[$this->lineFromFile(__DIR__ . DS . 'input'), 2], '86025'],
        ];
    }
}
