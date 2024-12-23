<?php

declare(strict_types=1);

namespace AOCTest\Year2016\Day05;

use AOCTest\Util\SolutionTestCase;
use AOC\Year2016\Day05\PartTwo;
use Override;

/**
 * @large
 */
class PartTwoTest extends SolutionTestCase
{
    protected string $solutionClass = PartTwo::class;

    /**
     * @inheritDoc
     */
    #[Override]
    public function data(): array
    {
        return [
            [[$this->generatorFromString('abc')], '05ace8e3'],
            [[$this->generatorFromString('uqwqemis')], '694190cd'],
        ];
    }
}
