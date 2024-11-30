<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day04;

use AOC\Year2015\Day04\PartOne;
use AOCTest\Util\SolutionTestCase;

/**
 * @medium
 */
class PartOneTest extends SolutionTestCase
{
    /** @var class-string */
    public string $solutionClass = PartOne::class;

    /**
     * @return array<int, array<mixed>>
     */
    #[\Override]
    public function data(): array
    {
        return [
            [['abcdef'], 609043],
            [['pqrstuv'], 1048970],
            [['bgvyzdsv'], 254575],
        ];
    }
}
