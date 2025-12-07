<?php

declare(strict_types=1);

namespace AOCTest\Year2025\Day06;

use AOC\Year2025\Day06\PartTwo;
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
            [[$this->generatorFromFileNoTrim(__DIR__ . DS . 'test')], 3263827],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 11052310600986],
        ];
    }
}
