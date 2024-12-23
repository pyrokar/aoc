<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day11;

use AOC\Year2015\Day11\PartOne;
use AOCTest\Util\SolutionTestCase;
use Override;

/**
 * @large
 */
class PartTwoTest extends SolutionTestCase
{
    /** @var class-string */
    public string $solutionClass = PartOne::class;

    /**
     * @return array<int, array<mixed>>
     */
    #[Override]
    public function data(): array
    {
        return [
            [['vzbxkghb'], 'vzbxxyzz'],
            [['vzbxxyzz'], 'vzcaabcc'],
        ];
    }
}
