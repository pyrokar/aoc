<?php

declare(strict_types=1);

namespace AOCTest\Year2019\Day06;

use AOC\Year2019\Day06\PartOne;
use AOCTest\Util\SolutionTestCase;
use Safe\Exceptions\FilesystemException;
use Override;

final class PartOneTest extends SolutionTestCase
{
    /** @var class-string */
    public string $solutionClass = PartOne::class;

    /**
     * @throws FilesystemException
     *
     * @return array<int, array<mixed>>
     */
    #[Override]
    public function data(): array
    {
        return [
            [[$this->generatorFromFile(__DIR__ . DS . 'test_1')], 42],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 140608],
        ];
    }
}
