<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day06;

use AOC\Year2015\Day06\PartOne;
use AOCTest\Util\SolutionTestCase;
use Safe\Exceptions\FilesystemException;

/**
 * @large
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
    #[\Override]
    public function data(): array
    {
        return [
            [[$this->generatorFromString('turn on 0,0 through 999,999')], 1000000],
            [[$this->generatorFromString('turn off 0,0 through 999,999')], 0],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 569999],
        ];
    }
}
