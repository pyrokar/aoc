<?php

declare(strict_types=1);

namespace AOCTest\Year2016\Day05;

use AOC\Year2016\Day05\PartOne;
use AOCTest\Util\SolutionTestCase;
use Override;
use PHPUnit\Framework\Attributes\Large;

#[Large]
class PartOneTest extends SolutionTestCase
{
    protected string $solutionClass = PartOne::class;

    /**
     * @inheritDoc
     */
    #[Override]
    public function data(): array
    {
        return [
            [[$this->generatorFromString('abc')], '18f47a30'],
            [[$this->generatorFromString('uqwqemis')], '1a3099aa'],
        ];
    }
}
