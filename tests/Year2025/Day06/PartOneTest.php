<?php

declare(strict_types=1);

namespace AOCTest\Year2025\Day06;

use AOC\Year2025\Day06\PartOne;
use AOCTest\Util\SolutionTestCase;
use Override;
use Safe\Exceptions\FilesystemException;

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
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], 4277556],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 6605396225322],
        ];
    }
}
