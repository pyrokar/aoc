<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day09;

use AOCTest\Util\SolutionTestCase;
use AOC\Year2015\Day09\PartOne;
use Safe\Exceptions\FilesystemException;
use Override;

/**
 * @medium
 */
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
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], 605],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 207],
        ];
    }
}
