<?php

declare(strict_types=1);

namespace AOCTest\Year2020\Day24;

use AOC\Year2020\Day24\PartOne;
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
     *
     */
    #[Override]
    public function data(): array
    {
        return [
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], 10],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 341],
        ];
    }
}
