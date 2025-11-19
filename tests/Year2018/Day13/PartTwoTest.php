<?php

declare(strict_types=1);

namespace AOCTest\Year2018\Day13;

use AOC\Year2018\Day13\PartTwo;
use AOCTest\Util\SolutionTestCase;
use Override;
use Safe\Exceptions\FilesystemException;

final class PartTwoTest extends SolutionTestCase
{
    /** @var class-string */
    public string $solutionClass = PartTwo::class;

    /**
     * @throws FilesystemException
     *
     * @return array<int, array<mixed>>
     */
    #[Override]
    public function data(): array
    {
        return [
            [[$this->generatorFromFileNoTrim(__DIR__ . DS . 'test_2')], '6,4'],
            [[$this->generatorFromFileNoTrim(__DIR__ . DS . 'input')], '16,134'],
        ];
    }
}
