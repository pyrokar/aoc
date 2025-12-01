<?php

declare(strict_types=1);

namespace AOCTest\Year2024\Day21;

use AOC\Year2024\Day21\Solution;
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
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], 126384],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 211930],
        ];
    }
}
