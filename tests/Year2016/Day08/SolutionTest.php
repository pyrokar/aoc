<?php

declare(strict_types=1);

namespace AOCTest\Year2016\Day08;

use AOCTest\Util\SolutionTestCase;
use AOC\Year2016\Day08\Solution;
use Safe\Exceptions\FilesystemException;
use Override;

class SolutionTest extends SolutionTestCase
{
    protected string $solutionClass = Solution::class;

    /**
     * @throws FilesystemException
     */
    #[Override]
    public function data(): array
    {
        return [
            [[$this->generatorFromFile(__DIR__ . DS . 'test'), 7, 3], 6],
            [[$this->generatorFromFile(__DIR__ . DS . 'input'), 50, 6], 121],
        ];
    }
}
