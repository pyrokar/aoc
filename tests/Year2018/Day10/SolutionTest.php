<?php

declare(strict_types=1);

namespace AOCTest\Year2018\Day10;

use AOC\Year2018\Day10\Solution;
use AOCTest\Util\SolutionTestCase;
use Override;
use Safe\Exceptions\FilesystemException;

final class SolutionTest extends SolutionTestCase
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
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], 3],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 10036],
        ];
    }
}
