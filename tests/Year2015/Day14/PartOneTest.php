<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day14;

use AOC\Year2015\Day14\PartOne;
use AOCTest\Util\SolutionTestCase;
use Safe\Exceptions\FilesystemException;
use Override;

class PartOneTest extends SolutionTestCase
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
            [[$this->generatorFromFile(__DIR__ . DS . 'test'), 1000], 1120],
            [[$this->generatorFromFile(__DIR__ . DS . 'input'), 2503], 2660],
        ];
    }
}
